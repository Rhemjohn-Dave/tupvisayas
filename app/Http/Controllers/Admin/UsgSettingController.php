<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class UsgSettingController extends Controller
{
    public function edit()
    {
        return view('admin.usg_settings.edit', [
            'about' => SiteSetting::getValue(SiteSetting::USG_ABOUT, ''),
            'mission' => SiteSetting::getValue(SiteSetting::USG_MISSION, ''),
            'vision' => SiteSetting::getValue(SiteSetting::USG_VISION, ''),
            'contactEmail' => SiteSetting::getValue(SiteSetting::USG_CONTACT_EMAIL, ''),
            'officeHours' => SiteSetting::getValue(SiteSetting::USG_OFFICE_HOURS, ''),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'about' => 'nullable|string|max:5000',
            'mission' => 'nullable|string|max:2000',
            'vision' => 'nullable|string|max:2000',
            'contact_email' => 'nullable|email|max:255',
            'office_hours' => 'nullable|string|max:255',
        ]);

        SiteSetting::setValue(SiteSetting::USG_ABOUT, $validated['about'] ?? '');
        SiteSetting::setValue(SiteSetting::USG_MISSION, $validated['mission'] ?? '');
        SiteSetting::setValue(SiteSetting::USG_VISION, $validated['vision'] ?? '');
        SiteSetting::setValue(SiteSetting::USG_CONTACT_EMAIL, $validated['contact_email'] ?? '');
        SiteSetting::setValue(SiteSetting::USG_OFFICE_HOURS, $validated['office_hours'] ?? '');

        return redirect()->route('admin.usg-settings.edit')
            ->with('success', 'USG page settings saved.');
    }
}
