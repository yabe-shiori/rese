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
                $this->import($file);
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

        $reader = IOFactory::createReader('Csv');
        $reader->setDelimiter(',');
        $spreadsheet = $reader->load($file->getPathname());
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        foreach (array_slice($sheetData, 1) as $row) {

            $areaName = $row['E'] ?? null;
            $genreName = $row['D'] ?? null;

            if (empty($areaName) || empty($genreName) || !isset($areaMapping[$areaName]) || !isset($genreMapping[$genreName])) {
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
    }
}
