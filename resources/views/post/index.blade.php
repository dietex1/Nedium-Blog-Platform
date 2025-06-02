<x-app-layout>

    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <x-category-tabs >
                        No Categories available.
                    </x-category-tabs>
                </div>
            </div>

            <div class=" text-gray-900 mt-8" >
                   @forelse($posts as $post)
                        <x-post-item :post="$post" />
                    @empty
                        <div class="text-center text-gray-500">
                            <p>No posts found.</p>
                        </div>
                   @endforelse
            </div>
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>
