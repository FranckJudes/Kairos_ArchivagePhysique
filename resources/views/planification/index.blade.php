@extends('Layout.main-layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/bundles/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar/fullcalendar.min.css')}}">
    <style>
        .calendar-container {
            background: #fff;
            width: 450px;
            border-radius: 10px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .calendar-container header {
            display: flex;
            align-items: center;
            padding: 25px 30px 10px;
            justify-content: space-between;
        }

        header .calendar-navigation {
            display: flex;
        }

        header .calendar-navigation span {
            height: 38px;
            width: 38px;
            margin: 0 1px;
            cursor: pointer;
            text-align: center;
            line-height: 38px;
            border-radius: 50%;
            user-select: none;
            color: #aeabab;
            font-size: 1.9rem;
        }

        .calendar-navigation span:last-child {
            margin-right: -10px;
        }

        header .calendar-navigation span:hover {
            background: #f2f2f2;
        }

        header .calendar-current-date {
            font-weight: 500;
            font-size: 1.45rem;
        }

        .calendar-body {
            padding: 20px;
        }

        .calendar-body ul {
            list-style: none;
            flex-wrap: wrap;
            display: flex;
            text-align: center;
        }

        .calendar-body .calendar-dates {
            margin-bottom: 20px;
        }

        .calendar-body li {
            width: calc(100% / 7);
            font-size: 1.07rem;
            color: #414141;
        }

        .calendar-body .calendar-weekdays li {
            cursor: default;
            font-weight: 500;
        }

        .calendar-body .calendar-dates li {
            margin-top: 30px;
            position: relative;
            z-index: 1;
            cursor: pointer;
        }

        .calendar-dates li.inactive {
            color: #aaa;
        }

        .calendar-dates li.active {
            color: #fff;
        }

        .calendar-dates li.selected {
            background-color: #28a745;
            color: #fff;
        }

        .calendar-dates li::before {
            position: absolute;
            content: "";
            z-index: -1;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .calendar-dates li.active::before {
            background: #6332c5;
        }

        .calendar-dates li:not(.active):hover::before {
            background: #e4e1e1;
        }

        .selected-date-display {
            margin-top: 20px;
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> App</a></li>
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Planifications</a></li>
        </ol>
    </nav>

    <div class="calendar-container">
        <header class="calendar-header">
            <p class="calendar-current-date"></p>
            <div class="calendar-navigation">
                <span id="calendar-prev" class="fa fa-chevron-left"></span>
                <span id="calendar-next" class="fa fa-chevron-right"></span>
            </div>
        </header>

        <div class="calendar-body">
            <ul class="calendar-weekdays">
                <li>Sun</li>
                <li>Mon</li>
                <li>Tue</li>
                <li>Wed</li>
                <li>Thu</li>
                <li>Fri</li>
                <li>Sat</li>
            </ul>
            <ul class="calendar-dates"></ul>
        </div>
        <div class="selected-date-display">
            <span id="selected-date">No date selected</span>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/bundles/prism/prism.js')}}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{asset('assets/bundles/fullcalendar.bundle.js')}}"></script>
    <script>
        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth();

        const day = document.querySelector(".calendar-dates");
        const currdate = document.querySelector(".calendar-current-date");
        const prenexIcons = document.querySelectorAll(".calendar-navigation span");
        const selectedDateDisplay = document.getElementById("selected-date");

        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        // Function to generate the calendar
        const manipulate = () => {
            let dayone = new Date(year, month, 1).getDay();
            let lastdate = new Date(year, month + 1, 0).getDate();
            let dayend = new Date(year, month, lastdate).getDay();
            let monthlastdate = new Date(year, month, 0).getDate();

            let lit = "";

            // Loop for last dates of the previous month
            for (let i = dayone; i > 0; i--) {
                lit += `<li class="inactive">${monthlastdate - i + 1}</li>`;
            }

            // Loop for current month's dates
            for (let i = 1; i <= lastdate; i++) {
                let isToday = i === date.getDate() && month === new Date().getMonth() && year === new Date().getFullYear() ? "active" : "";
                lit += `<li class="${isToday}" data-date="${year}-${month+1}-${i}">${i}</li>`;
            }

            // Loop for first dates of the next month
            for (let i = dayend; i < 6; i++) {
                lit += `<li class="inactive">${i - dayend + 1}</li>`;
            }

            currdate.innerText = `${months[month]} ${year}`;
            day.innerHTML = lit;
        }

        manipulate();

        // Navigation icons click event listener
        prenexIcons.forEach(icon => {
            icon.addEventListener("click", () => {
                month = icon.id === "calendar-prev" ? month - 1 : month + 1;

                if (month < 0 || month > 11) {
                    date = new Date(year, month, new Date().getDate());
                    year = date.getFullYear();
                    month = date.getMonth();
                } else {
                    date = new Date();
                }

                manipulate();
            });
        });

        // Add click event to each date
        day.addEventListener('click', function(event) {
            if (event.target.tagName.toLowerCase() === 'li' && !event.target.classList.contains('inactive')) {
                const selectedDate = event.target.getAttribute('data-date');
                selectedDateDisplay.innerText = `Selected Date: ${selectedDate}`;

                // Remove previous selection and add the new selected class
                const allDays = document.querySelectorAll('.calendar-dates li');
                allDays.forEach(day => day.classList.remove('selected'));
                event.target.classList.add('selected');
            }
        });
    </script>
@endsection
