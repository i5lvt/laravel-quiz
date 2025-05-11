<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            نموذج إدخال
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-md rounded-lg">
            <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">السؤال (عربي)</label>
                        <input type="text" name="question_ar" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">السؤال (إنجليزي)</label>
                        <input type="text" name="question_en" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                </div>

                @for($i = 0; $i < 4; $i++)
                <div class="flex gap-4 mt-4">
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">اختيار {{ $i + 1 }} (عربي)</label>
                        <input type="text" name="options_ar[]" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">Option {{ $i + 1 }} (إنجليزي)</label>
                        <input type="text" name="options_en[]" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                </div>
                @endfor

                <div class="flex gap-4 mt-4">
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">رقم الإجابة الصحيحة (1 إلى 4)</label>
                        <input type="number" name="correct_index" min="1" max="4" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                    <div class="flex-1">
                        <div class="flex-1">
                            <label class="block font-semibold text-gray-700 mb-1">لون البطاقة</label>
                            <input type="text" name="bg_color" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="#30918f">
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 mt-4">
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">لون الخط</label>
                        <input type="text" name="text_color" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="#ffffff">
                    </div>
                    <div class="flex-1">
                        <div class="flex-1">
                            <label class="block font-semibold text-gray-700 mb-1">لون الزر</label>
                            <input type="text" name="button_color" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="#ff9900">
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 mt-4">
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">🎥 فيديو عند الإجابة الصحيحة</label>
                        <input type="file" name="video_correct" accept="video/*" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    </div>
                    <div class="flex-1">
                        <label class="block font-semibold text-gray-700 mb-1">🎥 فيديو عند الإجابة الخاطئة</label>
                        <input type="file" name="video_wrong" accept="video/*" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2 rounded-lg">
                        💾 حفظ السؤال
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
