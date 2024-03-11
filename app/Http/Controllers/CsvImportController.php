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
            $areaName = $row['E'] ?? null;
            $genreName = $row['D'] ?? null;

            if (empty($row['A']) || empty($row['B']) || empty($row['C']) || empty($row['D']) || empty($row['E'])) {
                $errors[] = "CSVファイルの {$rowIndex} 行目のすべての項目が入力されていません。";
                continue;
            }

            if (!isset($areaMapping[$areaName]) || !isset($genreMapping[$genreName])) {
                $errors[] = "CSVファイルの {$rowIndex} 行目のエリア名またはジャンル名が無効です。";
                continue;
            }

            if (mb_strlen($row['A']) > 50) {
                $errors[] = "CSVファイルの {$rowIndex} 行目のnameは50文字以内で入力してください。";
                continue;
            }

            if (mb_strlen($row['B']) > 400) {
                $errors[] = "CSVファイルの {$rowIndex} 行目のdescriptionは400文字以内で入力してください。";
                continue;
            }

            $imageExtension = pathinfo($row['C'], PATHINFO_EXTENSION);
            if (!in_array($imageExtension, ['jpeg', 'jpg', 'png'], true)) {
                $errors[] = "CSVファイルの {$rowIndex} 行目の画像URLはjpegまたはpng形式で入力してください。";
                continue;
            }

            if (!in_array($areaName, array_keys($areaMapping))) {
                $errors[] = "CSVファイルの {$rowIndex} 行目のエリア名が無効です。";
                continue;
            }

            if (!in_array($genreName, array_keys($genreMapping))) {
                $errors[] = "CSVファイルの {$rowIndex} 行目のジャンル名が無効です。";
                continue;
            }

            $areaId = $areaMapping[$areaName];
            $genreId = $genreMapping[$genreName];

            $shop = new Shop();
            $shop->name = $row['A'];
            $shop->description = $row['B'];
            $shop->image = $row['C'];
            $shop->genre_id = $genreId;
            $shop->area_id = $areaId;

            $shop->save();
        }

        return $errors;
    }
}
