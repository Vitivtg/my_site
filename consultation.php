<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <style>
        .calendar {
            max-width: 400px;
            margin: 20px auto;
            border: 1px solid #ddd;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .calendar-header {
            background: #f4f4f4;
            padding: 10px;
            font-size: 20px;
            display: flex;
            justify-content: space-between;
        }
        .calendar-header button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .calendar-header button:hover {
            background: #0056b3;
        }
        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            background: #f9f9f9;
        }
        .day {
            padding: 10px;
            border: 1px solid #ddd;
            cursor: pointer;
        }
        .inactive {
            background: #e9e9e9;
            color: #bbb;
            cursor: not-allowed;
        }
        .today {
            background: #ffc107;
            font-weight: bold;
        }
        #time-select {
            margin: 20px auto;
            display: block;
            width: 80%;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="calendar">
        <div class="calendar-header">
            <button id="prev-month">←</button>
            <div id="calendar-header"></div>
            <button id="next-month">→</button>
        </div>
        <div class="calendar-days" id="calendar-days"></div>
    </div>

    <select id="time-select">
        <option>Выберите дату, чтобы увидеть доступное время</option>
    </select>

    <script>
        let currentYear, currentMonth;

        const renderCalendar = () => {
            const daysContainer = document.getElementById('calendar-days');
            const header = document.getElementById('calendar-header');
            const now = new Date();

            // Если текущий месяц и год не заданы, берем текущие
            if (currentYear === undefined || currentMonth === undefined) {
                currentYear = now.getFullYear();
                currentMonth = now.getMonth();
            }

            const monthNames = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
            header.textContent = `${monthNames[currentMonth]} ${currentYear}`;

            // Определяем первый день месяца и количество дней в месяце
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const prevDays = (firstDay === 0 ? 6 : firstDay - 1);

            // Очистка контейнера
            daysContainer.innerHTML = '';

            // Добавляем пустые ячейки перед первым днем месяца
            for (let i = 0; i < prevDays; i++) {
                daysContainer.innerHTML += '<div class="day inactive"></div>';
            }

            // Заполняем дни месяца
            for (let day = 1; day <= daysInMonth; day++) {
                const isToday = day === now.getDate() && currentMonth === now.getMonth() && currentYear === now.getFullYear();
                const isPastDate = new Date(currentYear, currentMonth, day) < now.setHours(0, 0, 0, 0);

                daysContainer.innerHTML += `
                    <div class="day ${isToday ? 'today' : ''} ${isPastDate ? 'inactive' : ''}" 
                         data-date="${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}">
                        ${day}
                    </div>`;
            }
        };

        // Обработчики переключения месяцев
        document.getElementById('prev-month').addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        });

        document.getElementById('next-month').addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        });

        // Загрузка времени сессий при выборе даты
        document.getElementById('calendar-days').addEventListener('click', (event) => {
            if (event.target.classList.contains('day') && !event.target.classList.contains('inactive')) {
                const selectedDate = event.target.dataset.date;
                console.log("Выбрана дата:", selectedDate);

                // AJAX-запрос на получение времени сессий
                fetch(`get_sessiontime.php?date=${selectedDate}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Ошибка загрузки данных');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const timeSelect = document.getElementById('time-select');
                        timeSelect.innerHTML = ''; // Очищаем предыдущие значения

                        if (data.length === 0) {
                            timeSelect.innerHTML = '<option>Нет доступного времени</option>';
                        } else {
                            data.forEach(session => {
                                const option = document.createElement('option');
                                option.value = session;
                                option.textContent = session;
                                timeSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Ошибка:', error);
                        alert('Ошибка загрузки данных. Попробуйте еще раз.');
                    });
            }
        });

        // Инициализация календаря
        renderCalendar();
    </script>
</body>
</html>
