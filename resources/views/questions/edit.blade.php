<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            تعديل سؤال
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-md rounded-lg">
            <form action="{{ route('questions.update', $question->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">السؤال (عربي)</label>
                        <input type="text" name="question_ar" value="{{ $question->question_ar }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">السؤال (إنجليزي)</label>
                        <input type="text" name="question_en" value="{{ $question->question_en }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                </div>

                @php
                    $options_ar = json_decode($question->options_ar);
                    $options_en = json_decode($question->options_en);
                @endphp

                @for($i = 0; $i < 4; $i++)
                    <div class="flex gap-4 mt-4">
                        <div class="flex-1">
                            <label class="block font-semibold text-gray-700 mb-1">اختيار {{ $i + 1 }} (عربي)</label>
                            <input type="text" name="options_ar[]" value="{{ $options_ar[$i] ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                        </div>
                        <div class="flex-1">
                            <label class="block font-semibold text-gray-700 mb-1">Option {{ $i + 1 }} (إنجليزي)</label>
                            <input type="text" name="options_en[]" value="{{ $options_en[$i] ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                        </div>
                    </div>
                @endfor

                <div class="flex gap-4 mt-4">
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">رقم الإجابة الصحيحة (1 إلى 4)</label>
                        <input type="number" name="correct_index" value="{{ $question->correct_index + 1 }}" min="1" max="4" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">لون البطاقة</label>
                        <input type="text" name="bg_color" value="{{ $question->bg_color }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="#30918f">
                    </div>
                </div>

                <div class="flex gap-4 mt-4">
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">لون الخط</label>
                        <input type="text" name="text_color" value="{{ $question->text_color }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="#ffffff">
                    </div>
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">لون الزر</label>
                        <input type="text" name="button_color" value="{{ $question->button_color }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="#ff9900">
                    </div>
                </div>

                <div class="flex gap-4 mt-4">
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">🎥 فيديو عند الإجابة الصحيحة</label>
                        <input type="file" name="video_correct" accept="video/*" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        @if($question->video_correct)
                            <small class="text-gray-500">الحالي: <a href="{{ asset('storage/' . $question->video_correct) }}" target="_blank" class="text-blue-600 underline">عرض</a></small>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">🎥 فيديو عند الإجابة الخاطئة</label>
                        <input type="file" name="video_wrong" accept="video/*" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        @if($question->video_wrong)
                            <small class="text-gray-500">الحالي: <a href="{{ asset('storage/' . $question->video_wrong) }}" target="_blank" class="text-blue-600 underline">عرض</a></small>
                        @endif
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2 rounded-lg">
                        💾 تحديث السؤال
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
