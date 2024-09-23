<?php

namespace App\Datatables;

use App\Enums\CategoriesEnum;
use App\Enums\StatusEnum;
use App\Interfaces\DatatableInterface;
use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PostDatatables implements DatatableInterface
{
    public $routePrefix = "admin.posts";

    public static function columns(): array
    {
        return [
            "title",
            "user_name",
            "created_at",
            "status",
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn("status", function (Post $post) {
                return $post->status == 1 ? __('Active') : __('unActive');
            })
            ->addColumn("user_name", function (Post $post) {
                return $post->user->name??'';
            })
            ->addColumn("actions", function (Post $post) {
                return (new DataTableActions())
                    ->edit(route($this->routePrefix . '.edit', $post->id),)
                    ->show(route($this->routePrefix.'.show', [$post->id, 'view' => "overview"]))
                    ->delete(route($this->routePrefix . '.destroy', $post->id),)
                    ->make();
            })
            ->rawColumns(["actions"])
            ->toJson(true);
    }

    public function query(Request $request): Builder
    {
        return Post::with('user:id,name')
            ->Filter()
            ->latest();
    }
}
