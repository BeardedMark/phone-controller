// Получаем элементы
const textInput = document.getElementById('phone');
const pasteBtn = document.getElementById('pasteBtn');
const copyBtn = document.getElementById('copyBtn');
const clearBtn = document.getElementById('clearBtn');

// Вставка текста из буфера
// pasteBtn.addEventListener('click', async () => {
//     try {
//         const text = await navigator.clipboard.readText(); // Чтение из буфера
//         textInput.value = text; // Вставляем текст в инпут
//     } catch (err) {
//         console.error('Ошибка при чтении из буфера: ', err);
//     }
// });

// Копирование текста в буфер
copyBtn.addEventListener('click', async () => {
    try {
        await navigator.clipboard.writeText(textInput.value); // Запись в буфер
        alert('Текст скопирован!');
    } catch (err) {
        console.error('Ошибка при копировании в буфер: ', err);
    }
});

// Очистка инпута
clearBtn.addEventListener('click', () => {
    textInput.value = ''; // Устанавливаем пустое значение
});
