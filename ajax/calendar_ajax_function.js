let student_course_name = "";
let allEvents = [];
var all_student_course_data = [];
jQuery(document).ready(function($) {
    // Helper: Map schedule string to days
    function getScheduleDays(schedule) {
        const mapping = {
            'M-F': ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'M-W-F': ['Monday', 'Wednesday', 'Friday'],
            'M-W': ['Monday', 'Wednesday'],
            'T-Thur': ['Tuesday', 'Thursday'],
            'Monday': ['Monday'],
            'Tuesday': ['Tuesday'],
            'Wednesday': ['Wednesday'],
            'Thursday': ['Thursday'],
            'Friday': ['Friday'],
            'Saturday': ['Saturday'],
            'Sunday': ['Sunday']
        };
        return mapping[schedule] || [schedule];
    }

    // Helper: Map day name to number
    const daysOfWeek = {
        'Monday': 1, 'Tuesday': 2, 'Wednesday': 3, 
        'Thursday': 4, 'Friday': 5, 'Saturday': 6, 'Sunday': 0
    };

    // Helper: Map day name to short code
    const shortDayNames = {
        Monday: 'MO', Tuesday: 'TU', Wednesday: 'WE',
        Thursday: 'TH', Friday: 'FR', Saturday: 'SA', Sunday: 'SU'
    };

    // Helper: Calculate end date for semester
    function getSemesterEndDate(semester, yearParts) {
        const endYear = yearParts.length > 1 ? yearParts[1] : new Date().getFullYear() + 1;
        if (semester.includes("summer")) return new Date(`${endYear}-07-31`);
        if (semester.includes("spring")) return new Date(`${endYear}-06-15`);
        if (semester.includes("fall")) return new Date(`${endYear}-01-15`);
        return new Date(`${endYear}-12-31`);
    }

    // Helper: Add event to calendar
    function addCalendarEvent(calendar, eventObj) {
        calendar.addEvent({
            ...eventObj,
            display: 'block',
            classNames: eventObj.classNames || [
                'rounded', 'shadow-lg', 'event-hover-effect', 'transition-all', 'text-center', 'text-wrap'
            ],
            textColor: eventObj.textColor || '#FFFFFF',
            backgroundColor: eventObj.backgroundColor || (eventObj.color ? eventObj.color + 'DD' : undefined)
        });
    }

    // Function to get and render student class data
    function getStudentClassData() {
        const studentColors = [
            '#456fb6', '#4CAF50', '#FF5722', '#9C27B0', '#FF9800',
            '#03A9F4', '#E91E63', '#8BC34A', '#673AB7', '#009688'
        ];
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: { action: 'get_student_course_data_by_registration_id' },
            success: function (data) {
                if (data.data.student_data) {
                    let studentColorMap = {};
                    data.data.student_data.forEach((student, index) => {
                        studentColorMap[student.id] = studentColors[index % studentColors.length];
                        let student_name = student.first_name;
                        if(student.student_course !== "[]") {
                            let studentCourse = JSON.parse(student.student_course);
                            all_student_course_data = all_student_course_data.concat(studentCourse);
                            studentCourse.forEach(student_course_data => {
                                if (student_course_data.event_id && student_course_data.event_id !== "0") return;
                                let student_course_name = student_course_data.courseName;
                                let course_schedule = student_course_data.schedule;
                                let course_semester = student_course_data.semester || "";
                                let academic_year = student_course_data.year || "";
                                let description = student_course_data.description || "";
                                let event_id = student_course_data.event_id || "0";
                                let currentCourse = {};
                                let courseIndex = all_student_course_data.findIndex(course => course.courseName === student_course_name && course.schedule === course_schedule && course.semester === course_semester && course.year === academic_year);
                                if (courseIndex !== -1) {
                                    currentCourse = all_student_course_data[courseIndex];
                                } else {
                                    all_student_course_data.push(student_course_data);
                                    currentCourse = student_course_data;
                                }
                                if (!course_schedule) return;
                                let yearParts = academic_year ? academic_year.split('-') : [];
                                let startYear = yearParts.length > 0 ? yearParts[0] : new Date().getFullYear();
                                let startDate = `${startYear}-09-01`;
                                let endRecur = getSemesterEndDate(course_semester, yearParts);
                                let scheduleDays = getScheduleDays(course_schedule);
                                const uniqueEventId = `${student.id}_${student_name}`;
                                const studentColor = studentColorMap[student.id];
                                scheduleDays.forEach(day => {
                                    let dayNum = daysOfWeek[day];
                                    if (dayNum !== undefined) {
                                        addCalendarEvent(calendar, {
                                            id: uniqueEventId,
                                            title: `${student_name} - ${student_course_name} Class`,
                                            startRecur: startDate,
                                            endRecur: endRecur,
                                            daysOfWeek: [dayNum],
                                            color: studentColor,
                                            extendedProps: {
                                                studentId: student.id,
                                                student_name,
                                                student_course_name,
                                                course_schedule,
                                                course_semester,
                                                course_name: student_course_name,
                                                course_id: courseIndex,
                                                academic_year,
                                                currentCourse,
                                                color: studentColor,
                                                description,
                                                event_id: event_id || "0",
                                                class: "yes",
                                                event_status: false,
                                            }
                                        });
                                    }
                                });
                                let mappedDays = (scheduleDays || []).map(d => shortDayNames[d]).filter(Boolean).join(',');
                                const diffTime = Math.abs(endRecur - new Date(startDate));
                                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                                const count = Math.ceil(diffDays / 7) + 1;
                                allEvents.push({
                                    id: uniqueEventId,
                                    name: `${student_name} - ${student_course_name}`,
                                    description: `${student_name} Classes for ${student_course_name}`,
                                    startDate,
                                    recurrence: `RRULE:FREQ=WEEKLY;COUNT=${count};BYDAY=${mappedDays}`
                                });
                            });
                        }
                    });
                }
                getCustomEventData();
            },
            error: function(error) { console.error("Error loading student data:", error); }
        });
    }

    // Function to get and render custom event data
    function getCustomEventData() {
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: { action: 'ajax_handle_get_custom_event_data' },
            success: function (data) {
                if (data.success && data.data.custom_event_data.length > 0) {
                    let customEventdata = data.data.custom_event_data.filter(event => event.source === 'custom' && event.hidden === "0");
                    customEventdata.forEach(event => {
                        const startDate = event.start_date;
                        const endDate = event.end_date;
                        const startTime = event.start_time;
                        const endTime = event.end_time;
                        const isMultiDay = startDate !== endDate;
                        if ((!event.recurrence || event.recurrence.toLowerCase() === 'none') && isMultiDay) {
                            const start = moment(startDate);
                            const daysDiff = moment(endDate).diff(start, 'days');
                            for (let i = 0; i <= daysDiff; i++) {
                                const currentDate = moment(startDate).add(i, 'days').format('YYYY-MM-DD');
                                addCalendarEvent(calendar, {
                                    id: `${event.id}_day_${i}`,
                                    title: event.title,
                                    start: `${currentDate}T${startTime}`,
                                    end: `${currentDate}T${endTime}`,
                                    color: event.color,
                                    borderColor: event.color,
                                    extendedProps: {
                                        registration_id: event.registration_id,
                                        description: event.description,
                                        startDate: event.start_date,
                                        endDate: event.end_date,
                                        color: event.color,
                                        recurrence: 'none',
                                        class: "no",
                                        event_id: event.id
                                    },
                                    classNames: ['rounded', 'shadow-sm', 'event-hover-effect', 'transition-all', 'text-center', 'text-wrap'],
                                    description: event.description || '',
                                    allDay: false
                                });
                            }
                        } else if (event.recurrence && event.recurrence.toLowerCase() !== 'none') {
                            const interval = parseInt(event.custom_interval, 10) || 1;
                            const frequency = event.recurrence === 'custom' ? event.custom_frequency : event.recurrence.toLowerCase();
                            const start = moment(startDate);
                            const daysDiff = moment(endDate).diff(start, 'days');
                            if (daysDiff > 0) {
                                for (let i = 0; i <= daysDiff; i++) {
                                    const currentDate = moment(startDate).add(i, 'days').format('YYYY-MM-DD');
                                    const recurringDates = calculateRecurringDates(
                                        new Date(`${currentDate}T${startTime}`), interval, frequency, 10
                                    );
                                    recurringDates.forEach((date, index) => {
                                        addCalendarEvent(calendar, {
                                            id: `${event.id}_recurrence_${i}_${index}`,
                                            title: event.title,
                                            start: moment(date).format('YYYY-MM-DD') + 'T' + startTime,
                                            end: moment(date).format('YYYY-MM-DD') + 'T' + endTime,
                                            color: event.color,
                                            borderColor: event.color,
                                            extendedProps: {
                                                registration_id: event.registration_id,
                                                description: event.description,
                                                recurrence: event.recurrence,
                                                color: event.color,
                                                startDate: event.start_date,
                                                endDate: event.end_date,
                                                custom_interval: event.custom_interval,
                                                custom_frequency: frequency,
                                                class: "no",
                                                event_id: event.id
                                            },
                                            classNames: ['rounded', 'shadow-sm', 'event-hover-effect', 'transition-all', 'text-center', 'text-wrap'],
                                            description: event.description || '',
                                            allDay: false
                                        });
                                    });
                                }
                            } else {
                                const recurringDates = calculateRecurringDates(
                                    new Date(startDate + 'T' + startTime), interval, frequency, 10
                                );
                                recurringDates.forEach((date, index) => {
                                    addCalendarEvent(calendar, {
                                        id: `${event.id}_recurrence_${index}`,
                                        title: event.title,
                                        start: moment(date).format('YYYY-MM-DD') + 'T' + startTime,
                                        end: moment(date).format('YYYY-MM-DD') + 'T' + endTime,
                                        color: event.color,
                                        borderColor: event.color,
                                        extendedProps: {
                                            registration_id: event.registration_id,
                                            description: event.description,
                                            recurrence: event.recurrence,
                                            startDate: event.start_date,
                                            color: event.color,
                                            endDate: event.end_date,
                                            custom_interval: event.custom_interval,
                                            custom_frequency: frequency,
                                            class: "no",
                                            event_id: event.id
                                        },
                                        classNames: ['rounded', 'shadow-sm', 'event-hover-effect', 'transition-all', 'text-center', 'text-wrap'],
                                        description: event.description || '',
                                        allDay: false
                                    });
                                });
                            }
                        } else {
                            addCalendarEvent(calendar, {
                                id: event.id + '_recurrence_0',
                                title: event.title,
                                start: startDate + 'T' + startTime,
                                end: endDate + 'T' + endTime,
                                color: event.color,
                                borderColor: event.color,
                                extendedProps: {
                                    registration_id: event.registration_id,
                                    description: event.description,
                                    startDate: event.start_date,
                                    endDate: event.end_date,
                                    color: event.color,
                                    recurrence: event.recurrence,
                                    custom_interval: event.custom_interval,
                                    custom_frequency: event.custom_frequency,
                                    class: "no",
                                    event_id: event.id
                                },
                                classNames: ['rounded', 'shadow-sm', 'event-hover-effect', 'transition-all', 'text-center', 'text-wrap'],
                                description: event.description || '',
                                allDay: false
                            });
                        }
                    });
                    allEvents = [
                        ...allEvents,
                        ...customEventdata.map(event => {
                            const isMultiDay = moment(event.end_date).diff(moment(event.start_date), 'days') > 0;
                            let recurrenceRule = '';
                            if (isMultiDay && (!event.recurrence || event.recurrence.toLowerCase() === 'none')) {
                                const dayCount = moment(event.end_date).diff(moment(event.start_date), 'days') + 1;
                                recurrenceRule = `RRULE:FREQ=DAILY;COUNT=${dayCount}`;
                            } else if (event.recurrence && event.recurrence.toLowerCase() !== 'none') {
                                const freq = event.recurrence === 'custom' ? event.custom_frequency?.toUpperCase() : event.recurrence.toUpperCase();
                                const interval = parseInt(event.custom_interval, 10) || 1;
                                recurrenceRule = `RRULE:FREQ=${freq};INTERVAL=${interval};COUNT=10`;
                            }
                            return {
                                name: event.title,
                                description: event.description,
                                startDate: event.start_date,
                                endDate: event.start_date,
                                startTime: event.start_time.slice(0, 5),
                                endTime: event.end_time.slice(0, 5),
                                recurrence: recurrenceRule
                            };
                        })
                    ];
                    let classesEventdata = data.data.custom_event_data.filter(event => event.source === 'class' && event.hidden === "0");
                    classesEventdata.forEach(event => {
                        const startDate = event.start_date;
                        const endDate = event.end_date;
                        const startTime = event.start_time;
                        const endTime = event.end_time;
                        const scheduleDays = getScheduleDays(event.class_schedule);
                        scheduleDays.forEach(day => {
                            const dayNum = daysOfWeek[day];
                            if (dayNum !== undefined) {
                                addCalendarEvent(calendar, {
                                    id: event.id,
                                    title: event.title,
                                    startRecur: startDate,
                                    endRecur: endDate,
                                    startTime,
                                    endTime,
                                    daysOfWeek: [dayNum],
                                    color: event.color,
                                    borderColor: event.color,
                                    extendedProps: {
                                        registration_id: event.registration_id,
                                        description: event.description,
                                        class_schedule: event.class_schedule,
                                        color: event.color,
                                        startDate: event.start_date,
                                        endDate: event.end_date,
                                        recurrence: 'weekly',
                                        class: "yes",
                                        studentId: event.student_id,
                                        event_id: event.id,
                                        event_status: true,
                                    },
                                    classNames: ['rounded', 'shadow-sm', 'event-hover-effect', 'transition-all', 'text-center', 'text-wrap'],
                                    description: event.description || '',
                                    allDay: false
                                });
                            }
                        });
                        let mappedDays = scheduleDays.map(d => shortDayNames[d]).filter(Boolean).join(',');
                        const diffDays = moment(endDate).diff(moment(startDate), 'days');
                        const count = Math.ceil(diffDays / 7) + 1;
                        allEvents.push({
                            id: event.id,
                            name: event.title,
                            description: event.description || "",
                            startDate,
                            endDate,
                            startTime: startTime.slice(0, 5),
                            endTime: endTime.slice(0, 5),
                            recurrence: `RRULE:FREQ=WEEKLY;COUNT=${count};BYDAY=${mappedDays}`
                        });
                    });
                    updateAddToCalendarButton();
                }
            },
            error: function(error) { console.error("Error loading custom events:", error); }
        });
    }

    function calculateRecurringDates(startDate, interval, frequency, count) {
        const dates = [];
        let currentStart = new Date(startDate);
        for (let i = 0; i < count; i++) {
            dates.push(new Date(currentStart));
            switch (frequency) {
                case 'daily': currentStart.setDate(currentStart.getDate() + interval); break;
                case 'weekly': currentStart.setDate(currentStart.getDate() + interval * 7); break;
                case 'monthly': currentStart.setMonth(currentStart.getMonth() + interval); break;
                case 'yearly': currentStart.setFullYear(currentStart.getFullYear() + interval); break;
                default: return [];
            }
        }
        return dates;
    }

    function updateAddToCalendarButton() {
        $('#addToCalendar').html(`
            <add-to-calendar-button
            name="Event Series"
            dates='${JSON.stringify(allEvents.map(event => ({
                name: event.name,
                description: event.description,
                startDate: event.startDate,
                endDate: event.endDate,
                startTime: event.startTime || '',
                endTime: event.endTime || '',
                recurrence: event.recurrence || ''
            })))}'
            iCalFileName="calendar_events"
            options="'Apple','Google','Outlook.com','iCal'"
            trigger="click"
            hideBackground
            hideCheckmark
            size="5"
            lightMode="system"
            ></add-to-calendar-button>
        `);
    }

    // Start the chain by calling getStudentClassData
    getStudentClassData();
    
    // Initialize the calendar
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'listWeek',
        locale: 'en',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: [],
        editable: true,
        dayMaxEvents: 3,
        dayMaxEventRows: 3,
        eventOrder: 'start,-duration,title',
        moreLinkClick: 'popover',
        eventDisplay: 'block',
        eventClassNames: function() {
            // Add custom classes for a professional look
            return [
                'rounded',
                'shadow',
                'event-hover-effect',
                'transition-all',
                'text-center',
                'text-wrap',
                'border-0',
                'fw-semibold'
            ];
        },
        eventContent: function(arg) {
            // Minimal event content: time and title in one line, description (truncated) below
            let title = arg.event.title;
            let time = arg.timeText ? arg.timeText + ' - ' : '';
            let desc = (arg.event.extendedProps && arg.event.extendedProps.description) ? arg.event.extendedProps.description : '';
            let shortDesc = desc.length > 30 ? desc.slice(0, 30) + '...' : desc;
            return {
                html: `<div><span class="fw-semibold">${time}${title}</span>${shortDesc ? `<br><span class="small">${shortDesc}</span>` : ''}</div>`
            };
        },
        eventClick: function(info) {
            let check = info.event.extendedProps.class;
            if (check === "yes") {
                swal({
                    title: "Class Event Options",
                    text: "This is a class event. You can only update it.",
                    icon: "info",
                    buttons: {
                        confirm: {
                            text: "Update",
                            value: "confirm",
                        },
                        cancel: "Cancel"
                    },
                    dangerMode: true,
                })
                .then((action) => {
                    if (action === "confirm") {
                        const event = info.event;

                        if (event.extendedProps.event_status){
                            // Extract class event data
                            // console.log("Event id:",event.extendedProps.event_id);
                            const eventId = event.extendedProps.event_id || "0";
                            const studentId = event.extendedProps.studentId;
                            const description = event.extendedProps.description || "";
                            const color = event.extendedProps.color;
                            const schedule = event.extendedProps.class_schedule;

                            // Get dates from event
                            const startDate = event.extendedProps.startDate;
                            const endDate = event.extendedProps.endDate;
                            const startTime = event.extendedProps.startTime || (event.start ? moment(event.start).format('HH:mm') : '');
                            const endTime = event.extendedProps.endTime || (event.end ? moment(event.end).format('HH:mm') : '');
                            const title = event.title;

                            // console.log("starttime:", startTime);
                            // console.log("endTime:", endTime);
                            // Set values in the modal fields
                            // $('#editEventType').val('class');
                            document.getElementById('editEventType').value = 'class';
                            // console.log("Event type set to:", document.getElementById('editEventType').value);
                            $('#editEventId').val(eventId);
                            $('#editEventStudentId').val(studentId);
                            $('#editTitle').val(title);
                            $('#editDescription').val(description);
                            $('#editStartDate').val(startDate);
                            $('#editEndDate').val(endDate);
                            $('#editStartTime').val(startTime);
                            $('#editEndTime').val(endTime);
                            $('#editColor').val(color);

                            // Configure form sections for class events
                            $('#recurrenceSection').hide();
                            $('#classScheduleSection').show();
                            $('#editEndDateNote').removeClass('d-none');
                            $('#editClassSchedule').val(schedule);
                        }
                        else {
                             // Extract class event data
                            const studentId = event.extendedProps.studentId;
                            const eventId = event.extendedProps.event_id || "0";
                            const student_name = event.extendedProps.student_name;
                            const courseName = event.extendedProps.student_course_name;
                            const description = event.extendedProps.description || "";
                            const schedule = event.extendedProps.course_schedule;
                            const semester = event.extendedProps.course_semester || "";
                            const year = event.extendedProps.academic_year || "";
                            const color = event.extendedProps.color || "#456fb6";
                            const currentCourse = event.extendedProps.currentCourse;

                            // Parse semester string into an array of semesters
                            let semesters = [];
                            if (semester.toLowerCase().includes('fall')) semesters.push('Fall');
                            if (semester.toLowerCase().includes('spring')) semesters.push('Spring');
                            if (semester.toLowerCase().includes('summer')) semesters.push('Summer');

                            // Set values in the modal fields - use direct DOM access to ensure it's set
                            document.getElementById('editEventType').value = 'class';
                            // console.log("Event type set to:", document.getElementById('editEventType').value);
                            $('#editEventId').val(eventId);
                            $('#editEventStudentId').val(studentId);

                            // Find course index if it's needed
                            const courseIndex = event.extendedProps.course_id;
                            $('#editEventCourseId').val(courseIndex);
                            $('#editTitle').val(`${student_name} - ${courseName} Class`);
                            $('#editDescription').val(description);

                            // Calculate start and end dates based on semester and academic year
                            let startDate = '';
                            let endDate = '';
                            if (year) {
                                const yearStart = year.split('-')[0];
                                const yearEnd = year.split('-')[1] || (parseInt(yearStart) + 1).toString();
                                startDate = `${yearStart}-09-01`;
                                
                                if (semester.toLowerCase().includes('fall') && !semester.toLowerCase().includes('spring') && !semester.toLowerCase().includes('summer')) {
                                    endDate = `${yearEnd}-01-15`;
                                } else if (semester.toLowerCase().includes('spring') && !semester.toLowerCase().includes('summer')) {
                                    endDate = `${yearEnd}-06-15`;
                                } else if (semester.toLowerCase().includes('summer')) {
                                    endDate = `${yearEnd}-07-31`;
                                } else {
                                    endDate = `${yearEnd}-06-15`;
                                }
                            }

                            $('#editStartDate').val(startDate);
                            $('#editEndDate').val(endDate);
                            $('#editColor').val(color);

                            // Configure form sections for class events
                            $('#recurrenceSection').hide();
                            $('#classScheduleSection').show();
                            $('#editEndDateNote').removeClass('d-none');
                            $('#editClassSchedule').val(schedule);
                        }
                        // console.log("Event Data:", event);
                        new bootstrap.Modal(document.getElementById('editEventModal')).show();
                    }
                });
            } else {
                swal({
                    title: "Event Options",
                    text: "What would you like to do with this event?",
                    icon: "info",
                    buttons: {
                        confirm: {
                            text: "Update",
                            value: "confirm",
                        },
                        delete: {
                            text: "Delete",
                            value: "delete",
                        },
                        cancel: "Cancel"
                    },
                    dangerMode: true,
                })
                .then((action) => {
                    if (action === "confirm") {
                        const event = info.event;
                        const startDate = event.extendedProps.startDate;
                        const endDate = event.extendedProps.endDate;
                        const color = event.extendedProps.color;
                        $('#editEventId').val(event.id);
                        // Set values in the modal fields
                        // $('#editEventType').val('custom');
                        document.getElementById('editEventType').value = 'custom';
                        // console.log("Event type set to:", document.getElementById('editEventType').value);
                        $('#editTitle').val(event.title);
                        $('#editDescription').val(event.extendedProps.description);
                        $('#editStartDate').val(startDate);
                        $('#editEndDate').val(endDate);
                        $('#editStartTime').val(moment(event.start).format('HH:mm'));
                        $('#editEndTime').val(moment(event.end).format('HH:mm'));
                        $('#editColor').val(color);
                        $('#editRecurrence').val(event.extendedProps.recurrence || 'none');
                        // Configure form sections for class events
                        $('#recurrenceSection').show();
                        $('#classScheduleSection').hide();

                        if (event.extendedProps.recurrence === 'custom') {
                            $('#editCustomRecurrenceOptions').show();
                            $('#editCustomInterval').val(event.extendedProps.custom_interval);
                            $('#editCustomFrequency').val(event.extendedProps.custom_frequency);
                        } else {
                            $('#editCustomRecurrenceOptions').hide();
                        }

                        new bootstrap.Modal(document.getElementById('editEventModal')).show();
                    } else if (action === "delete") {
                        swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this event!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    type: 'POST',
                                    url: ajax_object.ajax_url,
                                    data: {
                                        action: 'ajax_handle_delete_custom_event_data',
                                        event_id: info.event.extendedProps.event_id
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            swal("Success", "Event deleted successfully", "success").then(() => {
                                                location.reload();
                                            });
                                        } else {
                                            swal("Error", "Failed to delete event", "error");
                                        }
                                    }
                                });
                            }
                        });
                    }
                });
            }
        },
        eventDrop: function(info) {
            if (info.event.title.endsWith("Class")) {
                swal("Info", "Student class events cannot be moved.", "info");
                info.revert();
                return;
            }
            if (!info.event.id.endsWith('_recurrence_0')) {
                swal("Info", "Only original events can be moved.", "info");
                info.revert();
                return;
            }
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    action: 'ajax_handle_drag_drop_update_event_date',
                    event_id: info.event.id,
                    date: moment(info.event.start).format('YYYY-MM-DD'),
                },
                success: function(response) {
                    if (response.success) {
                        swal("Success", "Event updated successfully", "success").then(() => {
                            location.reload();
                        });
                    } else {
                        swal("Error", "Failed to update event", "error");
                        info.revert();
                    }
                },
                error: function() {
                    swal("Error", "Failed to update event", "error");
                    info.revert();
                }
            });
        }
    });
    calendar.render();

    // Show custom recurrence options when custom is selected
    $('#recurrence').on('change', function() {
        const customOptions = $('#customRecurrenceOptions');
        if (this.value === 'custom') {
            customOptions.show();
            // make fields requried
            $('#customInterval').attr('required', true);
            $('#customFrequency').attr('required', true);
        } else {
            customOptions.hide();
            // remove values from fields
            $('#customInterval').val('');
            $('#customFrequency').val('');

            // remove required attribute
            $('#customInterval').removeAttr('required');
            $('#customFrequency').removeAttr('required');
        }
    });

    // Add event details in the database
    $('#eventForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        // Add event to database
        formData.append('action', 'ajax_handle_save_custom_event_data');
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.success) {
                    swal("Success", "Event added successfully", "success").then(() => {
                        // this.reset();
                        const modal = document.getElementById('openEventModal');
                        bootstrap.Modal.getInstance(modal).hide();
                        // calendar.addEvent({
                        //     title: formData.get('title'),
                        //     start: formData.get('date') + 'T' + formData.get('time'),
                        //     color: formData.get('color'),
                        //     extendedProps: {
                        //         recurrence: formData.get('recurrence'),
                        //         description: formData.get('description'),
                        //         custom_interval: formData.get('custom_interval'),
                        //         custom_frequency: formData.get('custom_frequency')
                        //     }
                        // });
                        location.reload();
                    });
                } else {
                    swal("Error", "Failed to add event", "error");
                }
            }
        });
    });

    // Show custom recurrence options when custom is selected for edit event
    $('#editRecurrence').on('change', function() {
        const customOptions = $('#editCustomRecurrenceOptions');
        if (this.value === 'custom') {
            customOptions.show();
            // make fields requried
            $('#editCustomInterval').attr('required', true);
            $('#editCustomFrequency').attr('required', true);
        } else {
            customOptions.hide();
            // remove values from fields
            $('#editCustomInterval').val('');
            $('#editCustomFrequency').val('');

            // remove required attribute
            $('#editCustomInterval').removeAttr('required');
            $('#editCustomFrequency').removeAttr('required');
        }
    });

    // Update event details in the database
    $('#editEventForm').on('submit', function(e) {
        e.preventDefault();
        // Get form data from the editEventForm
        const form = document.getElementById('editEventForm');
        const formData = new FormData(form);

        // Get the selected event type
        const eventType = $('#editEventType').val();
        // console.log("event type:", eventType);
        if (eventType === 'class') {
            // Optionally, add extra data if needed (e.g., action for WP AJAX)
            formData.append('action', 'ajax_handle_add_student_class_in_calendar');

            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.success) {
                        swal("Success", data.data.message, "success");
                        const modal = document.getElementById('editEventModal');
                        var event_id = $('#editEventId').val();
                        bootstrap.Modal.getInstance(modal).hide();
                        if (event_id === 0){
                            var course_index = $('#editEventCourseId').val();
                            var student_id = parseInt($('#editEventStudentId').val());

                            // find by course index and update the event id
                            all_student_course_data[course_index].event_id = data.data.event_id;

                            // refresh the modal
                            $('#editEventForm').trigger('reset');
                            // console.log('course after edit', all_student_course_data[course_index]);

                            // find all the course data by student id
                            // Get all courses for this student
                            let course_data = all_student_course_data.filter(c => c.student_id === student_id);
                            // console.log('Filtered student courses:', course_data);

                            // Save the updated course data back to the server
                            $.ajax({
                                type: 'POST',
                                url: ajax_object.ajax_url,
                                data: {
                                    'action': 'save_student_course',
                                    'student_id': student_id,
                                    'student_course': JSON.stringify(course_data),
                                },
                                success: function (response) {
                                    if (response.success) {
                                        swal("Success", "Course calendar events updated successfully!", "success");
                                        location.reload();
                                    } else {
                                        swal("Error", "Failed to update course calendar events", "error");
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("AJAX error:", error);
                                    swal("Error", "Failed to update course calendar events", "error");
                                }
                            });
                        } 
                        // reload the page
                        location.reload();
                    } else {
                        swal("Error", "Failed to update event", "error");
                    }
                }
            });            
        }
        else {
            // Update event in database
            formData.append('action', 'ajax_handle_update_custom_event_data');
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.success) {
                        swal("Success", data.data.message, "success").then(() => {
                            // this.reset();
                            const modal = document.getElementById('editEventModal');
                            bootstrap.Modal.getInstance(modal).hide();
                            location.reload();
                        });
                    } else {
                        swal("Error", "Failed to update event", "error");
                    }
                }
            });
        }

    });
 
});