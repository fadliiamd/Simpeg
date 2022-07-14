<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('date_indo')) {
  function date_indo($date){
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    
    // pemisahan tahun, bulan, hari, dan waktu
    $tahun = substr($date,0,4);
    $bulan = substr($date,5,2);
    $tgl = substr($date,8,2);
    $waktu = substr($date,11,5);
    $hari = date("w",strtotime($date));
    $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu;

    return $result;
  }
}

if (!function_exists('getFormattedDate')) {
  function getFormattedDate($date, $prefomattedDate = false, $hideYear = false) {
    $timestamp = strtotime($date);

    $MONTH_NAMES = [
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $day = date('d', $timestamp);
    $month = $MONTH_NAMES[(int)date('m', $timestamp) - 1];
    $year = date('Y', $timestamp);
    $hours = date('H', $timestamp);
    $minutes = date('i', $timestamp);

    if ($minutes < 10) {
      $minutes = "0{$minutes}";
    }

    if ($prefomattedDate) {
      // Hari ini pada 10:20
      // Kemarin pada 10:20
      return "{$prefomattedDate} pada {$hours}:{$minutes}";
    }

    if ($hideYear) {
      // 10 January pada 10:20
      return "{$day} {$month} pada {$hours}:{$minutes}";
    }

    // 10 January 2017 pada 10:20
    return "{$day} {$month} {$year} pada {$hours}:{$minutes}";
  }
}

if (!function_exists('timeAgo')) {
  function timeAgo($dateParam) {
    if(!$dateParam) {
      return null;
    }

    $date = strtotime($dateParam);
    $DAY_IN_S = 86400; // 24 * 60 * 60
    $today = strtotime(date('Y-m-d H:i:s'));
    $yesterday = date('Y-m-d H:i:s', $today - $DAY_IN_S);
    $seconds = round(($today - $date));
    $minutes = round($seconds / 60);
    $isToday = date('d', $today) === date('d', $date);
    $isYesterday = $yesterday === $date;
    $isThisYear = date('Y', $today) === date('Y', $date);

    if ($seconds < 5) {
      return "baru saja";
    } else if ($seconds < 60) {
      return "{$seconds} detik yang lalu";
    } else if ($seconds < 90) {
      return "sekitar semenit yang lalu";
    } else if ($minutes < 60) {
      return "{$minutes} menit yang lalu";
    } else if ($isToday) {
      return getFormattedDate(date('Y-m-d H:i:s', $date), "Hari ini"); // Hari ini pada 10:20
    } else if ($isYesterday) {
      return getFormattedDate(date('Y-m-d H:i:s', $date), "Kemarin"); // Kemarin pada 10:20
    } else if ($isThisYear) {
      return getFormattedDate(date('Y-m-d H:i:s', $date), false, true); // 10 January pada 10:20
    }

    return getFormattedDate($date); // 10 January 2017 pada 10:20
  }
}