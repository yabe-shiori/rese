<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Shop;


class CsvImportController extends Controller
{
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
            'イタリアン' => 3,
            '居酒屋' => 4,
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

            $this->saveShop($row, $areaMapping, $genreMapping);
        }

        return $errors;
    }

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

    private function saveShop($row, $areaMapping, $genreMapping)
    {
        $areaName = $row['E'];
        $genreName = $row['D'];

        $areaId = $areaMapping[$areaName];
        $genreId = $genreMapping[$genreName];

        $managerId = $row['F'];

        $shop = new Shop();
        $shop->name = $row['A'];
        $shop->description = $row['B'];
        $shop->image = $row['C'];
        $shop->genre_id = $genreId;
        $shop->area_id = $areaId;

        $shop->manager_id = $managerId;

        $shop->save();
    }
}
