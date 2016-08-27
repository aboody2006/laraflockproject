<?php
if (!function_exists('addButton')) {
    function addButton($master)
    {
        if (Sentinel::hasAnyAccess(['admin', 'create_' . $master])) {

            return "<a href = \"" . route($master . ".create") . "\" > Add new " . $master . " </a >";
        }

    }
}

if (!function_exists('importButton')) {
    function importButton($master)
    {
        if (Sentinel::hasAnyAccess(['admin', 'import_' . $master])) {

            $button = "<a href = \"" . route($master . ".import") . "\" > Import " . $master . " </a >";

            return $button;
        }

    }
}

if (!function_exists('exportButton')) {
    function exportButton($master)
    {
        if (Sentinel::hasAnyAccess(['admin', 'export_' . $master])) {

            $button = "<a href = \"" . route($master . ".export") . "\" > Export " . $master . " </a >";

            return $button;
        }

    }
}

if (!function_exists('showButton')) {
    function showButton($master, $id)
    {
        if (Sentinel::hasAnyAccess(['admin', 'view_' . $master])) {
            $button = "<a href=\"";
            $button .= route($master . '.show', ['id' => $id]);
            $button .= "\" class=\"btn btn-xs btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Show";
            $button .= "\"><i class=\"fa fa-eye\"></i></a>";

            return $button;
        }

    }
}

if (!function_exists('editButton')) {
    function editButton($master, $id)
    {
        if (Sentinel::hasAnyAccess(['admin', 'edit_' . $master])) {
            $button = "<a href=\"";
            $button .= route($master . '.edit', ['id' => $id]);
            $button .= "\" class=\"btn btn-xs btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"";
            $button .= trans('dashboard::dashboard.buttons.edit');
            $button .= "\"><i class=\"fa fa-pencil\"></i></a>";
            return $button;
        }

    }
}

if (!function_exists('deleteButton')) {
    function deleteButton($master)
    {
        if (Sentinel::hasAnyAccess(['admin', 'delete_' . $master])) {

            $button = BootForm::submit('<i class="fa fa-trash"></i><span class="sr-only">' . trans('dashboard::dashboard.buttons.delete') . '</span>');
            $button->addClass('btn btn-xs btn-danger')->removeClass('btn-default');
            $button->data('toggle', 'tooltip');
            $button->data('placement', 'top');
            $button->title(trans('dashboard::dashboard.buttons.delete'));
            return $button;
        }

    }
}