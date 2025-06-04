<x-app-layout>

    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-2xl font-bold mb-4 flex justify-center">Update Post</h1>
                <form action="{{route('post.update',$post->id)}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Title -->
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title',$post->title)" required autofocus  />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="mt-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select required  id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category',$post->category->id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- Content -->
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-text-area id="content" name="content" :value="$post->content" class="block mt-1 w-full" required />

                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    @if ($post->image)
                        <div>
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="block mt-1 w-full">
                        </div>
                    @endif

                    <!-- Image -->
                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        <x-text-input id="image" class="block mt-1 w-full border-2" type="file" name="image" :value="old('image')"  autofocus  />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </form>
            </div>


        </div>
    </div>
</x-app-layout>
