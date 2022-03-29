<?php


namespace App\Helpers\Customer;


class Levy
{
    public static function getStatus($status, $format = false)
    {
        if($format == false) {
            switch ($status) {
                case 'waiting':
                    return 'En attente';
                    break;

                case 'processed':
                    return 'Traité';
                    break;

                case 'rejected':
                    return 'Rejeté interbancaire';
                    break;

                case 'return':
                    return 'Retourné';
                    break;

                case 'refunded':
                    return 'Remboursé';
                    break;

                default: return "Inconnue"; break;
            }
        } else {
            switch ($status) {
                case 'waiting':
                    return '<span class="badge badge-pill badge-sm badge-warning">En attente</span>';
                    break;

                case 'processed':
                    return '<span class="badge badge-pill badge-sm badge-success">Traité</span>';
                    break;

                case 'rejected':
                    return '<span class="badge badge-pill badge-sm badge-danger">Rejeté Interbancaire</span>';
                    break;

                case 'return':
                    return '<span class="badge badge-pill badge-sm badge-info">Retourné</span>';
                    break;

                case 'refunded':
                    return '<span class="badge badge-pill badge-sm badge-success">Remboursé</span>';
                    break;

                default: return "Inconnue"; break;
            }
        }
    }

    public static function generateICS()
    {
        return \Str::upper("FR".rand(0,99).randomString(3).rand(100000,999999));
    }

    public static function generateRUM()
    {
        return \Str::upper(randomString(3).\Str::random('30'));
    }
}
