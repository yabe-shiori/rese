<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class CsvImportController extends Controller
{
    public function upload(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', '管理者権限が必要です。');
        }

        if (!$request->hasFile('csv_file')) {
            return redirect()->back()->with('error', 'CSVファイルを選択してください。');
        }

        $file = $request->file('csv_file');

        if ($file->getClientOriginalExtension() !== 'csv') {
            return redirect()->back()->with('error', '選択されたファイルはCSV形式ではありません。');
        }

        $errors = $this->import($file);

        if (!empty($errors)) {
            return redirect()->back()->with('errors', $errors);
        }

        return redirect()->back()->with('message', '店舗情報が登録されました。');
    }


    //csvファイルから店舗情報をインポートする
    private function import($file)
    {
        $areaMapping = [
            '東京都' => 1,
            '大阪府' => 2,
            '福岡県' => 3,
        ];

        $genreMapping = [
            '寿司' => 1,
            '焼肉' => 2,
            '居酒屋' => 3,
            'イタリアン' => 4,
            'ラーメン' => 5,
        ];

        $errors = [];

        DB::beginTransaction();

        try {
            $reader = IOFactory::createReader('Csv');
            $reader->setDelimiter(',');
            $spreadsheet = $reader->load($file->getPathname());
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            foreach (array_slice($sheetData, 1) as $rowIndex => $row) {

                $error = $this->validateRow($row, $rowIndex, $areaMapping, $genreMapping);
                if (!empty($error)) {
                    $errors[] = $error;
                    continue;
                }

                $saved = $this->saveShop($row, $areaMapping, $genreMapping);
                if ($saved === true) {
                    session()->flash('message', '店舗情報が登録されました。');
                } elseif ($saved === 'exists') {
                    $errors[] = "同じmanager_idの店舗が既に存在しているため、登録できませんでした。";
                } else {
                    $errors[] = "存在しないmanager_idが指定されたため、登録できませんでした。";
                }
            }

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();
            $errors[] = $e->getMessage();
        }

        return $errors;
    }

    //店舗情報のバリデーション
    private function validateRow($row, $rowIndex, $areaMapping, $genreMapping)
    {

        if (empty($row['A']) || empty($row['B']) || empty($row['C']) || empty($row['D']) || empty($row['E']) || empty($row['F'])) {
            return "入力されていない項目があります。";
        }

        $areaName = $row['E'];
        $genreName = $row['D'];

        if (!isset($areaMapping[$areaName]) || !isset($genreMapping[$genreName])) {
            return "地域名またはジャンル名が無効です。";
        }

        if (mb_strlen($row['A']) > 50) {
            return "店舗名は50文字以内で入力してください。";
        }

        if (mb_strlen($row['B']) > 400) {
            return "店舗概要は400文字以内で入力してください。";
        }

        $imageExtension = pathinfo($row['C'], PATHINFO_EXTENSION);
        if (!in_array($imageExtension, ['jpeg', 'jpg', 'png'], true)) {
            return "画像URLはjpegまたはpng形式で入力してください。";
        }

        return null;
    }

    //店舗情報を保存する
    private function saveShop($row, $areaMapping, $genreMapping)
    {
        DB::beginTransaction();

        try {
            $areaName = $row['E'];
            $genreName = $row['D'];

            $areaId = $areaMapping[$areaName];
            $genreId = $genreMapping[$genreName];

            $managerId = $row['F'];

            $managerUser = User::where('id', $managerId)->where('role', 'manager')->first();
            if (!$managerUser) {
                DB::rollBack();
                return 'not_manager';
            }

            $existingShop = Shop::where('manager_id', $managerId)->exists();
            if ($existingShop) {
                DB::rollBack();
                return 'exists';
            }

            $shop = new Shop();
            $shop->name = $row['A'];
            $shop->description = $row['B'];
            $shop->image = $row['C'];
            $shop->genre_id = $genreId;
            $shop->area_id = $areaId;
            $shop->manager_id = $managerId;

            $shop->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
