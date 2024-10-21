<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;

trait Buttons
{
    /**
     * Menampilkan button show
     */
    public function _Show($params)
    {
        return '<button class="btn btn-sm btn-info" onclick="showModal(' . $params->id . ')"><i class="fas fa-eye"></i></button>';
    }

    /**
     * Menampilkan button edit
     */
    public function _Edit($params)
    {
        return '<button class="btn btn-sm btn-primary" onclick="editModal(' . $params->id . ')"><i class="fas fa-edit"></i></button>';
    }

    /**
     * Menampilkan button delete
     */
    public function _Delete($params)
    {
        return '<button class="btn btn-sm btn-danger ml-1" onclick="openModal(' . $params->id . ')"><i class="fas fa-trash-alt"></i></button>';
    }

    /**
     * Menampilkan button print
     */
    public function _Print($params)
    {
        return '<button class="btn btn-sm btn-warning ml-1" onclick="downloadButton(' . $params->id . ')"><i class="fas fa-download"></i></button>';
    }

    /**
     * Menampilkan button edit pada REPORT
     */
    public function _Edit_2($params, $edit_2_name)
    {
        return '<a href="/report-' . $edit_2_name . '/edit/' . $params->id . '" class="btn btn-sm btn-success ml-1"><i class="fas fa-edit"></i></a>';
    }

    /**
     * Menampilkan button delete pada REPORT
     */
    public function _Delete_2($params)
    {
        return '<button class="btn btn-sm btn-danger ml-1" onclick="deleteModal(' . $params->id . ')"><i class="fas fa-trash-alt"></i></button>';
    }

    /**
     * Berfungsi untuk cek role user yang login apakah ADMIN atau QC
     */
    public function _CheckRole($params, $edit_2_name)
    {
        // CEK NAMA ROUTE DARI HALAMAN YANG DIAKSES
        $route_name = Route::currentRouteName();

        if (auth()->user()->hasRole('admin|qc')) {
            if ((strpos($route_name, "report") !== false)) {
                $show    = $this->_Show($params);
                $print   = $this->_Print($params);
                if (auth()->user()->hasRole('admin')) {
                    $edit2   = $this->_Edit_2($params, $edit_2_name);
                    $delete2   = $this->_Delete_2($params);
                    return '<div class="d-flex">' . $show . $print . $edit2 . $delete2 . '</div>';
                }
                return '<div class="d-flex">' . $show . $print . '</div>';
            } else {
                $edit   = $this->_Edit($params);
                $delete = $this->_Delete($params);
                return '<div class="d-flex">' . $edit . $delete . '</div>';
            }
        }
        return '';
    }
}
