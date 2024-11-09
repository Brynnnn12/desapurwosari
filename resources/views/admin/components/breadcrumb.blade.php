<!-- resources/views/partials/breadcrumb.blade.php -->
<nav class="flex px-5 py-3 text-gray-700 rounded-lg   aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                    </path>
                </svg>
                Home
            </a>
        </li>

        @foreach ($breadcrumbs as $breadcrumb)
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </li>
        <li class="inline-flex items-center">
            @if ($loop->last)
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    {{ $breadcrumb['name'] }}
                </span>
            @else
                <a href="{{ $breadcrumb['url'] }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    {{ $breadcrumb['name'] }}
                </a>
            @endif
        </li>
        @endforeach
    </ol>
</nav>
