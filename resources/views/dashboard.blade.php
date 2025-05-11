<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('لوحة التحكم') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- بطاقات الإحصائيات --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-blue-500 text-white rounded-lg p-4 shadow">
                <h3 class="text-lg font-semibold mb-1">عدد الأسئلة</h3>
                <p class="text-2xl">{{ $totalQuestions }}</p>
            </div>
            <div class="bg-green-500 text-white rounded-lg p-4 shadow">
                <h3 class="text-lg font-semibold mb-1">إجابات صحيحة</h3>
                <p class="text-2xl">{{ $correctAnswers }}</p>
            </div>
            <div class="bg-red-500 text-white rounded-lg p-4 shadow">
                <h3 class="text-lg font-semibold mb-1">إجابات خاطئة</h3>
                <p class="text-2xl">{{ $wrongAnswers }}</p>
            </div>
            <div class="bg-gray-800 text-white rounded-lg p-4 shadow">
                <h3 class="text-lg font-semibold mb-1">عدد الزوار</h3>
                <p class="text-2xl">{{ $visitors }}</p>
            </div>
        </div>

        {{-- زر إضافة سؤال --}}
        <div class="text-end">
            <a href="{{ route('questions.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                ➕ إضافة سؤال
            </a>
        </div>

        {{-- جدول الأسئلة --}}
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-right">
                        <thead class="bg-gray-100 text-gray-600 font-semibold">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">السؤال (عربي)</th>
                            <th class="px-4 py-2">السؤال (إنجليزي)</th>
                            <th class="px-4 py-2">الخيارات (عربي)</th>
                            <th class="px-4 py-2">الخيارات (إنجليزي)</th>
                            <th class="px-4 py-2">الصحيح</th>
                            <th class="px-4 py-2">الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($questions as $question)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $question->id }}</td>
                                <td class="px-4 py-2">{{ $question->question_ar }}</td>
                                <td class="px-4 py-2">{{ $question->question_en }}</td>
                                <td class="px-4 py-2">
                                    @foreach(json_decode($question->options_ar) as $option)
                                        <div>- {{ $option }}</div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2">
                                    @foreach(json_decode($question->options_en) as $option)
                                        <div>- {{ $option }}</div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2 text-center">{{ $question->correct_index + 1 }}</td>
                                <td class="px-4 py-2 space-x-1 rtl:space-x-reverse">
                                    <a href="{{ route('questions.edit', $question->id) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">✏️ تعديل</a>
                                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">🗑️ حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center text-gray-500">لا توجد أسئلة حالياً.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
