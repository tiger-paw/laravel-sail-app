<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            個別表示
        </h2>
    </x-slot>

    <div class="max-w7xl mx-auto px-6">
        <div class="bg-white w-full rounded-2xl">
            <h1 class="text-lg font-semibold">
                {{ $post->title }}
            </h1>
            <div class="text-right">
                <a href="{{route('post.edit', $post)}}">
                    <x-primary-button>
                        編集
                    </x-primary-button>
                </a>

                <form action="{{route('post.destroy', $post)}}" method="post" class="flex-2">
                    @csrf
                    @method('delete')
                    <x-primary-button class="bg-red-700 ml-2">
                        削除
                    </x-primary-button>
                </form>
            </div>
            <hr class="w-full">
            <p class="mt-4 whitespace-pre-line">
                {{$post->body}}
            </p>
            <div class="text-sm font-semibold flex flex-row-reverse">
                <p> {{$post->created_at}}</p>
            </div>
        </div>
    </div>
</x-app-layout>
