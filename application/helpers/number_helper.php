<?php


function rupiah($number)
{
  $hasil_rupiah = "Rp " . number_format($number, 2, ',', '.');
  return $hasil_rupiah;
}
