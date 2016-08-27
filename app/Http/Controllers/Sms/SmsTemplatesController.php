<?php

namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseDashboardController;
use App\Models\Sms\SmsTemplates;
use Laracasts\Flash\Flash;

class SmsTemplatesController extends BaseDashboardController
{
    public function index()
    {
        $templates = SmsTemplates::all();

        if (count($templates) < 1)
        {
            Flash::warning('Templates not fount. Please, add new template');

            return redirect()->route('sms.templates.create');
        }

        return view('dashboard.sms.templates.index', ['templates' => $templates]);
    }

    public function createTemplate()
    {
        return view('dashboard.sms.templates.create');
    }

    public function saveTemplate(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);

        $request['message'] = trim($request['message']);

        $template = new SmsTemplates();
        $template->fill($request->all());
        $template->save();

        Flash::success('New SMS Template with message "' . $template->message . '" was added');

        return redirect()->route('sms.templates.index');
    }

    public function showTemplate($templateId)
    {
        if (!$template = SmsTemplates::find($templateId))
        {
            Flash::error('SMS Template not found');

            return redirect()->route('sms.templates.index');
        }

        return view('dashboard.sms.templates.show', ['template' => $template]);
    }

    public function editTemplate($templateId)
    {
        if (!$template = SmsTemplates::find($templateId))
        {
            Flash::error('SMS Template not found');

            return redirect()->route('sms.templates.index');
        }

        return view('dashboard.sms.templates.edit', ['template' => $template]);
    }

    public function updateTemplate(Request $request, $templateId)
    {
        $this->validate($request, [
            'message' => 'required'
        ]);

        if (!$template = SmsTemplates::find($templateId))
        {
            Flash::error('SMS Template not found');

            return redirect()->route('sms.templates.index');
        }

        $request['message'] = trim($request['message']);

        $oldMessage = $template->message;
        $template->fill($request->all());
        $template->save();

        Flash::success('SMS Template with "' . $oldMessage . '" was updated with "' . $template->message , '"');

        return redirect()->route('sms.templates.index');
    }

    public function deleteTemplate($templateId)
    {
        if (!$template = SmsTemplates::find($templateId))
        {
            Flash::error('Template not found');

            return redirect()->route('sms.templates.index');
        }

        $template->delete();

        Flash::success('SMS Template with message "' . $template->message . '" was deleted');

        return redirect()->route('sms.templates.index');
    }
}
