<?php

namespace App\Exports;

use App\Cobranza;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class CobranzasExport implements FromArray, WithHeadings, WithColumnFormatting,ShouldAutoSize,WithEvents
{
    protected $datos;
    protected $tipo;

    public function __construct(array $datos)
    {

        $this->datos = $datos[0];
        $this->tipo = $datos[1];
    }

    public function array(): array
    {
        return $this->datos;
    }
    public function headings() : array
    {
        if($this->tipo == '01') {
            return [
                'ID',
                'Fecha Cobranza',
                'PERSONAL',
                'CLIENTE',
                'Total Cobranza'
            ];
        }

        return [
            'MES',
            'PERSONAL',
            'Total Cobranza'
        ];
    }

    public function columnFormats(): array
    {
        if( $this->tipo == '01') {
            return [
                'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            ];
        }

        return [
            'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $cellRange = ($this->tipo == '01') ?  'A1:E1' : 'A1:C1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray(
                    array(
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' =>Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                                ]
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                        'font' => array(
                            'name' => 'Calibri',
                            'size' => 12,
                            'color' => array('rgb' => 'FFFFFF')
                        ),
                    )
                );
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
                                        ->setFillType(Fill::FILL_SOLID)
                                        ->getStartColor()->setRGB('0489B1');

                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);
            },
        ];
    }
}
