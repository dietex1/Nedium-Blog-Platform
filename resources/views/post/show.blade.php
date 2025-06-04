<x-app-layout>
    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>
                <!-- User -->
                <div class="flex gap-4 items-start">
                    @if($post->user->image)
                        <img src="{{ Storage::url($post->user->image) }}" alt="{{ $post->user->name }}" class="w-12 h-12 rounded-full">
                    @else
                        <img src="{{ Storage::url('avatars/dummy.png') }}" alt="Default Avatar" class="w-12 h-12 rounded-full">
                    @endif

                    <div>
                        <x-follow-ctr :user="$post->user"  class="flex gap-2">
                            <a class="font-semibold hover:underline" href="{{route('profile.show', $post->user)}}" >{{ $post->user->name }}</a>
                            @if (auth()->check() && auth()->user()->id !== $post->user->id)
                                &middot;
                                <button  class=" font-semibold" x-text="following ? 'Unfollow' : 'Follow'"
                                   :class="following ? 'text-red-400' : 'text-emerald-400'" @click="follow()"></button>
                            @endif
                        </x-follow-ctr>
                        <div class="flex gap-2 text-gray-500 text-sm">
                            {{ $post->readTime() }} min read
                            &middot;
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    @if ($post->user->id === auth()->id())
                        <div class="ml-auto flex gap-2">
                            <x-primary-button href="{{ route('post.edit', $post->slug) }}">
                                Edit post
                            </x-primary-button>
                            <form action="{{ route('post.destroy', $post) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <x-danger-button href="">
                                    Delete
                                </x-danger-button>
                            </form>
                        </div>
                    @endif
                </div>

                <x-likes-button :post="$post" class="mt-6" />

                <!-- Post -->
                <div class="mt-6">
                    @if($post->image)
                        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-auto rounded-lg mb-4">
                    @endif
                    <div class="prose dark:prose-invert">
                        {{$post->content }}
                    </div>
                </div>

                <div class="mt-8 text-black text-sm">
                    <span class="font-semibold bg-gray-200 rounded-lg p-2 " >Category:  {{$post->category->name}}</span>
                </div>

                <x-likes-button :post="$post" class="mt-6" />

            </div>
        </div>
    </div>
</x-app-layout>
