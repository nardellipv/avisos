<?php

namespace App\Http\Controllers\adminUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateClientProfileRequest;
use App\NewsLetter;
use App\User;
use Image;
use Illuminate\Support\Str;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Jambasangsang\Flash\Facades\LaravelFlash;

class ProfileController extends Controller
{
    public function updateProfile(UpdateClientProfileRequest $request, $id)
    {
        $user = User::find($id);

        $this->authorize('updateClient', $user);

        $user->name = $request['name'];
        $user->lastname = $request['lastname'];
        // $user->email = $request['email'];
        $user->region_id = $request['region_id'];

        $path = 'users/' . $user->id;
        $pathSub = 'users/' . $user->id . '/images';

        if (!is_dir($path)) {
            mkdir('users/' . $user->id);
        }
        if (!is_dir($pathSub)) {
            mkdir('users/' . $user->id . '/images');
        }

        if ($request->photo) {
            $image = $request->file('photo');
            $input['photo120'] = '120x120-' . $user->id . '-' . $image->getClientOriginalName();

            $img = Image::make($image->getRealPath());
            $img->fit(120, 120)->save($path . '/images/' . $input['photo120']);

            $user->photo = Str::after($input['photo120'], '-');
        }

        $user->save();

        LaravelFlash::withInfo('Perfil modificado correctamente');
        return redirect()->action('adminUser\DashboardController@index');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        LaravelFlash::withInfo('Perfil modificado correctamente');
        return back();
    }

    public function updateNewsLetters(Request $request)
    {
        $user = User::where('email', userConnect()->email)
            ->first();

        $this->authorize('updateClient', $user);

        if ($request->recive) {
            $user->recive = 'Y';
        } else {
            $user->recive = 'N';
        }
        $user->save();

        LaravelFlash::withInfo('Perfil modificado correctamente');
        return back();
    }
}
