<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Shop;
use App\Models\User;


class CsvImportController extends Controller
{
    //csvファイルをアップロードして店舗情報をインポートする
    public function upload(Request $request)
    {
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');

            if ($file->getClientOriginalExtension() === 'csv') {
                $errors = $this->import($file);

                if (!empty($errors)) {
                    return redirect()->back()->with('errors', $errors);
                }

                return redirect()->back()->with('message', '店舗情報が登録されました。');
            } else {
                return redirect()->back()->with('error', 'ファイル形式が異なります。');
            }
        }
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
                $errors[] = "同じマネージャーIDの店舗が既に存在するため、登録されませんでした。";
            } else {
                $errors[] = "存在しないmanager_idが指定されたため、登録できませんでした。";
            }
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
            return "エリア名またはジャンル名が無効です。";
        }

        if (mb_strlen($row['A']) > 50) {
            return "nameは50文字以内で入力してください。";
        }

        if (mb_strlen($row['B']) > 400) {
            return "descriptionは400文字以内で入力してください。";
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
        $areaName = $row['E'];
        $genreName = $row['D'];

        $areaId = $areaMapping[$areaName];
        $genreId = $genreMapping[$genreName];

        $managerId = $row['F'];

        $userExists = User::where('id', $managerId)->exists();
        if (!$userExists) {
            return 'not_exists';
        }

        $existingShop = Shop::where('manager_id', $managerId)->exists();
        if ($existingShop) {
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

        return true;
    }
}
