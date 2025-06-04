<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex">
                    <div class="flex-1 pr-10">
                        <h1 class="text-5xl">{{$user->name}}</h1>
                        <div class="mt-8">
                           @forelse($user->posts as $post)
                                <x-post-item :post="$post" />
                            @empty
                                <div class="text-center text-gray-500">
                                    <p>No posts found.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div
                        x-data="{
                                following: @json($user->isFollowedBy(auth()->user())),
                                followersCount: @json($user->followers()->count()),
                                follow() {
                                    axios.post('/follow/{{ $user->id }}')
                                    .then(res => {
                                          this.following = !this.following;
                                          this.followersCount = res.data.followersCount;
                                        })
                                            .catch(err => console.error(err));
                                    }
                                 }"
                        class="w-[320px]  px-8"
                    >
                        @if($user->image)
                            <img src="{{ Storage::url($user->image) }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full">
                        @else
                            <img src="{{ Storage::url('avatars/dummy.png') }}" alt="Default Avatar" class="w-20 h-20 rounded-full">
                        @endif
                        <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
                        <p class="text-gray-500"> <span x-text="followersCount"></span> folowers </p>
                        <p>
                            {{ $user->bio ?? 'No bio available.' }}
                        </p>
                        @auth
                          @if($user->id !== auth()->id() )
                            <div class="mt-4">
                                <button @click="follow()" class=" rounded-full text-white px-4 py-2 transition-colors duration-300"
                                        x-text="following ? 'Unfollow' : 'Follow'"
                                        :class="following ? 'bg-red-600 hover:bg-red-700' : 'bg-emerald-600 hover:bg-emerald-700'">
                                </button>
                            </div>
                          @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
