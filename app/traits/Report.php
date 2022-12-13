<?php
    namespace app\traits;
    use Dompdf\Dompdf;
    trait Report{
            public function print ($html)
            {
                $dompdf = new Dompdf();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'landscape');
                $dompdf->render();
                $dompdf->stream();
            }
        }