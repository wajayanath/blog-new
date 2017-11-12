<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //get current user
        $currentUser = $request->user();
        
        //get current action name
        $currentActionName = $request->route()->getActionName();

        list($controller, $method) = explode('@', $currentActionName);
        $controller = str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller);

        $crudPermissionMap = [
        'crud' => ['create', 'store', 'edit', 'update', 'destroy', 'restore', 'forceDestroy', 'index', 'view']
        ];

        $classesMap = [
            'Blog'       =>  'post',
            'Categories' => 'category',
            'Users'      => 'user'
        ];

        foreach ($crudPermissionMap as $permission => $methods)
        {
            if (in_array($method, $methods) && isset($classesMap[$controller]))
            {
                $className = $classesMap[$controller];
                // dd("{$permission}-{$className}");

                if($className == 'post' && in_array($method, ['edit','update', 'destroy', 'restore', 'forceDestroy'])) {
                    // dd("current user try to edit/delete a post");
                    //if the current user has not update/delete-other-post permission
                    //make sure he/she only modify his/her own post
                     if ( ($id = $request->route("blog")) && (!$currentUser->can('update-other-post') || !$currentUser->can('delete-other-post')) ) {
                        $post = \App\Post::find($id);
                        if ($post->author_id !== $currentUser->id) {
                            // dd("cannot update/delete other post");
                            abort(403,"Forbidden access !");
                        }
                     }
                }

                // if the user has not permission don't allow next request
                elseif (! $currentUser->can("{$permission}-{$className}")) {
                    abort(403,"Forbidden access !");
                }
                break;

            }
        }

        return $next($request);
    }
}
