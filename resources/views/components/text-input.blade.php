@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-200 dark:text-gray-900 focus:border-indigo-500 dark:focus:border-teal-400 focus:ring-indigo-500 dark:focus:ring-indigo-100 rounded-md shadow-sm']) }}>
