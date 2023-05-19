<!DOCTYPE html>
<html>
<head>
  <title>Календарь</title>
  <style>
    .calendar {
      display: flex;
      flex-wrap: wrap;
      width: 300px;
    }
    
    .calendar .day {
      width: 40px;
      height: 40px;
      line-height: 40px;
      text-align: center;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>
  <h1>Календарь</h1>
  <div id="calendarContainer"></div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function createCalendar(month, year) {
      var daysInMonth = new Date(year, month, 0).getDate();
      var firstDay = new Date(year, month - 1, 1).getDay();
      var startDay = (firstDay === 0) ? 6 : firstDay - 1; // Коррекция для начала недели с понедельника
      
      var calendar = $('<div>').addClass('calendar');
      
      // Добавляем заголовки дней недели
      var daysOfWeek = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
      for (var i = 0; i < 7; i++) {
        calendar.append($('<div>').addClass('day').text(daysOfWeek[i]));
      }
      
      // Добавляем пустые ячейки перед первым днем месяца
      for (var i = 0; i < startDay; i++) {
        calendar.append($('<div>').addClass('day'));
      }
      
      // Добавляем дни месяца
      for (var i = 1; i <= daysInMonth; i++) {
        calendar.append($('<div>').addClass('day').text(i));
      }
      
      $('#calendarContainer').html(calendar);
    }
    
    // Пример использования
    var month = 4; // Май
    var year = 2023;
    createCalendar(month, year);
  </script>
</body>
</html>
