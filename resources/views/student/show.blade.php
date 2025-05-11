<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>اختبر نفسك</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-8 px-4">

@if ($question)
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md mx-auto p-4 sm:p-6 text-center relative">

        {{-- زر تغيير اللغة --}}
        <button id="toggleLang"
                class="absolute top-3 right-3 bg-blue-100 text-blue-700 text-xs sm:text-sm font-medium px-3 py-1 rounded hover:bg-blue-200 transition">
            🌐 تغيير اللغة
        </button>

        {{-- عنوان --}}
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Question</h1>

        {{-- السؤال --}}
        <p class="text-lg text-gray-700 mb-6" id="questionText"
           data-en="{{ $question->question_en }}"
           data-ar="{{ $question->question_ar }}">
            {{ $question->question_en }}
        </p>

        {{-- الخيارات --}}
        <div class="space-y-3" id="optionsList">
            @foreach(json_decode($question->options_en) as $index => $option)
                <button
                    class="answer-btn w-full bg-gray-200 hover:bg-blue-200 text-gray-800 font-semibold py-2 px-4 rounded"
                    data-index="{{ $index }}"
                    data-correct="{{ $question->correct_index }}"
                    data-en="{{ $option }}"
                    data-ar="{{ json_decode($question->options_ar)[$index] }}"
                >
                    {{ $option }}
                </button>
            @endforeach
        </div>

        {{-- الفيديو --}}
        <div id="reaction" class="mt-6 hidden"></div>
    </div>
@else
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md mx-auto p-6 text-center">
        <h2 class="text-xl font-bold text-red-600">لا يوجد أسئلة حالياً</h2>
        <p class="text-gray-600 mt-2">يرجى إضافة أسئلة من لوحة التحكم.</p>
    </div>
@endif

<script>
    const buttons = document.querySelectorAll('.answer-btn');
    const correctIndex = buttons.length ? Number(buttons[0].dataset.correct) : null;
    const reactionDiv = document.getElementById('reaction');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach((b, i) => {
                b.classList.remove('bg-gray-200', 'bg-green-500', 'bg-red-500');
                if (i === correctIndex) {
                    b.classList.add('bg-green-500', 'text-white');
                }
                if (i == btn.dataset.index && i != correctIndex) {
                    b.classList.add('bg-red-500', 'text-white');
                }
                b.disabled = true;
            });

            const correct = Number(btn.dataset.index) === correctIndex;
            const videoPath = correct
                ? "{{ asset('storage/' . $question->video_correct) }}"
                : "{{ asset('storage/' . $question->video_wrong) }}";

            reactionDiv.innerHTML = `<video src="${videoPath}" class="w-full rounded mt-4" controls autoplay></video>`;
            reactionDiv.classList.remove('hidden');

            // إرسال النتيجة إلى السيرفر
            fetch("{{ route('student.record') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    question_id: {{ $question->id }},
                    is_correct: correct
                })
            });
        });
    });

    // زر تغيير اللغة
    const toggleBtn = document.getElementById('toggleLang');
    const questionText = document.getElementById('questionText');
    let isEnglish = true;

    toggleBtn.addEventListener('click', () => {
        isEnglish = !isEnglish;
        questionText.textContent = isEnglish ? questionText.dataset.en : questionText.dataset.ar;

        buttons.forEach(btn => {
            btn.textContent = isEnglish ? btn.dataset.en : btn.dataset.ar;
        });
    });
</script>

</body>
</html>
