<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        try {
            $users = $this->userRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data user berhasil ditemukan', UserResource::collection($users), 200);
        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function getAllPaginated(Request $request)
    {
        $request = $request->validate([
            'search' => 'string|nullable',
            'row_per_page' => 'integer|nullable',
        ]);

        try {
            $users = $this->userRepository->getAllPaginated($request['search'] ?? null, $request['row_per_page']);

            return ResponseHelper::jsonResponse(true, 'Data user berhasil ditemukan', PaginateResource::make($users, UserResource::class), 200);

        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function store(UserStoreRequest $request)
    {
        $request = $request->validated();
        try {
            $user = $this->userRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data user berhasil disimpan', new UserResource($user), 201);
        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function show(string $id)
    {
        try {
            $user = $this->userRepository->getById($id);

            if (! $user) {
                return ResponseHelper::jsonResponse(false, 'Data user gagal ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data user berhasil ditemukan', new UserResource($user), 200);

        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $request = $request->validated();
        try {
            $user = User::find($id);
            if (! $user) {
                return ResponseHelper::jsonResponse(false, 'Data user gagal ditemukan', null, 404);
            }
            $user = $this->userRepository->update($id, $request);

            return ResponseHelper::jsonResponse(true, 'Data user berhasil diupdate', new UserResource($user), 201);
        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $user = $this->userRepository->getById($id);
            if (! $user) {
                return ResponseHelper::jsonResponse(false, 'Data user gagal ditemukan', null, 404);
            }

            $user = $this->userRepository->delete($id);

            return ResponseHelper::jsonResponse(true, 'Data user berhasil dihapus', new UserResource($user), 201);

        } catch (\Exception $exception) {
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }
}
