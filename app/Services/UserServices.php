<?php

namespace App\Services;

use App\Events\WelcomeMail;
use App\Models\image;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserServices
{
    /**
     * UserServices constructor.
     *
     * @param  User  $user
     */
    public function __construct(
        protected User $user
    ) {
    }

    /**
     * For list all user data with search user feature.
     *
     * @param  string|int  $search
     * @return User
     */
    public function list($search)
    {
        try {
            if ($search != null) {
                $users = $this->user->Search($search)->simplePaginate(6);
            } else {
                $users = $this->user->simplePaginate(6);
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return $users;
    }

    /**
     * For store and update an user.
     *
     * @param  array  $data
     * @return mixed
     */
    public function store(array $data)
    {
        dd($data);
        DB::beginTransaction();

        try {
            if (isset($data['id'])) {
                $this->updateUser($data);
                event(new WelcomeMail($this->user));
            } else {
                $this->createUser($data);
            }
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        DB::commit();
    }

    /**
     * For store user.
     *
     * @param  array  $data
     * @return User
     */
    public function createUser(array $data)
    {
        $users = $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'image' => $this->saveGoogleImage($data) ?? null,
            'password' => Hash::make($data['password'] ?? null),
            'birthday' => $data['birthday'] ?? null,
            'locale' => $data['locale'] ?? null,
        ]);

        return $users;
    }

    /**
     * For update user.
     *
     * @param  array  $data
     * @return User
     */
    public function updateUser(array $data)
    {
        $this->user->FindUser($data)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'birthday' => $data['birthday'],
            'locale' => $data['locale'],
        ]);
    }

    /**
     * For store multiple image.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function multiImageUpload($request)
    {
        DB::beginTransaction();

        try {
            $image = new image();
            $files = $request->file('photos');
            $i = 1;
            foreach ($files as $file) {
                $extension = $file->extension();
                $filename = time() . $i . '.' . $extension;
                $file->storeAs('/public/multiUpload', $filename);
                $data[] = $filename;
                $i++;
            }

            $image->name = json_encode($data);
            $image->save();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }

        DB::commit();
    }

    /**
     * For save image from google login API
     *
     * @param array $data
     * @return string
     */
    public function saveGoogleImage($data): string
    {
        $avatar = $data['picture'];
        $file = file_get_contents($avatar);
        $filename = time() . '.jpg';
        Storage::build('storage/upload/user')->put($filename, $file);

        return $filename;
    }
}
