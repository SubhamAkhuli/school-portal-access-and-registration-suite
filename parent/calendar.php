<!-- Calendar page content -->
<div style="display: flex; gap: 10px; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
    <!-- Add to Calendar Button -->
    <div id = "addToCalendar"></div>
    
    <!-- Add Event Button -->
    <button class="btn blue-btn" style="text-align: right;" data-bs-toggle="modal" data-bs-target="#openEventModal">Add Event</button>
</div>

<!-- Calendar container -->
<div id="calendar"></div>

<!-- Add event Modal structure -->
<div class="modal fade" id="openEventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; box-shadow: 0 0 20px rgb(32, 32, 32);">
            <div class="modal-header text-white" style="border-radius: 15px 15px 0 0; background-color: #456fb6;">
                <h5 class="modal-title" id="eventModalLabel" style="font-weight: 600;">Add Event</h5>
                <button class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <form id="eventForm" style="display: flex; flex-direction: column; gap: 1rem;">
                    <div class="form-group">
                        <label for="title" style="font-weight: 600; margin-bottom: 0.5rem;">Event Name:</label>
                        <input type="text" id="title" name="title" required class="form-control form-control-lg" style="border-radius: 8px;" />
                    </div>

                    <div class="form-group">
                        <label for="description" style="font-weight: 600; margin-bottom: 0.5rem;">Description:</label>
                        <textarea id="description" name="description" class="form-control" rows="3" maxlength="500" style="border-radius: 8px; resize: none;"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="date" style="font-weight: 600; margin-bottom: 0.5rem;">Date:</label>
                            <input type="date" id="date" name="date" required class="form-control" style="border-radius: 8px;"
                                min="<?php echo date('Y-m-d'); ?>" />
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label for="color" style="font-weight: 600; margin-bottom: 0.5rem;">Category Color:</label>
                            <input type="color" id="color" name="color" class="form-control" style="height: 2.5rem; border-radius: 8px;" 
                                oninput="if (this.value.toLowerCase() === '#3788d8') { this.value = '#000000'; alert('This color is not allowed.'); }" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="startTime" style="font-weight: 600; margin-bottom: 0.5rem;">Start Time:</label>
                            <input type="time" id="startTime" name="startTime" required class="form-control" style="border-radius: 8px;" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="endTime" style="font-weight: 600; margin-bottom: 0.5rem;">End Time:</label>
                            <input type="time" id="endTime" name="endTime" required class="form-control" style="border-radius: 8px;" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="recurrence" style="font-weight: 600; margin-bottom: 0.5rem;">Recurrence:</label>
                        <select id="recurrence" name="recurrence" class="form-control" style="border-radius: 8px;"> 
                            <option value="none">None</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>

                    <div id="customRecurrenceOptions" style="display: none; gap: 1rem;">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="customInterval" style="font-weight: 600; margin-bottom: 0.5rem;">Interval:</label>
                                <input type="number" id="customInterval" name="customInterval" min="1" class="form-control" 
                                    style="border-radius: 8px;" placeholder="Every X days/weeks/months" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="customFrequency" style="font-weight: 600; margin-bottom: 0.5rem;">Frequency:</label>
                                <select id="customFrequency" name="customFrequency" class="form-control" style="border-radius: 8px;">
                                    <option value="">Select Frequency</option>
                                    <option value="daily">Days</option>
                                    <option value="weekly">Weeks</option>
                                    <option value="monthly">Months</option>
                                    <option value="yearly">Years</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button class="btn blue-btn btn-lg mt-3" style="border-radius: 8px;">
                        Add Event
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit event Modal structure -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; box-shadow: 0 0 20px rgb(32, 32, 32) ;">
            <div class="modal-header text-white" style="border-radius: 15px 15px 0 0; background-color: #456fb6;">
                <h5 class="modal-title" id="editEventModalLabel" style="font-weight: 600;">Edit Event</h5>
                <button class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <form id="editEventForm" style="display: flex; flex-direction: column; gap: 1rem;">
                    <input type="hidden" id="editEventId" name="editEventId" />
                    
                    <div class="form-group">
                        <label for="editTitle" style="font-weight: 600; margin-bottom: 0.5rem;">Event Name:</label>
                        <input type="text" id="editTitle" name="editTitle" required class="form-control form-control-lg" style="border-radius: 8px;" />
                    </div>

                    <div class="form-group">
                        <label for="editDescription" style="font-weight: 600; margin-bottom: 0.5rem;">Description:</label>
                        <textarea id="editDescription" name="editDescription" class="form-control" rows="3" maxlength="500" style="border-radius: 8px; resize: none;"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="editDate" style="font-weight: 600; margin-bottom: 0.5rem;">Date:</label>
                            <input type="date" id="editDate" name="editDate" required class="form-control" style="border-radius: 8px;"
                                min="<?php echo date('Y-m-d'); ?>" />
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label for="editColor" style="font-weight: 600; margin-bottom: 0.5rem;">Category Color:</label>
                            <input type="color" id="editColor" name="editColor" class="form-control" style="height: 2.5rem; border-radius: 8px;"
                                oninput="if (this.value.toLowerCase() === '#3788d8') { this.value = '#000000'; alert('This color is not allowed.'); }" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="editStartTime" style="font-weight: 600; margin-bottom: 0.5rem;">Start Time:</label>
                            <input type="time" id="editStartTime" name="editStartTime" required class="form-control" style="border-radius: 8px;" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="editEndTime" style="font-weight: 600; margin-bottom: 0.5rem;">End Time:</label>
                            <input type="time" id="editEndTime" name="editEndTime" required class="form-control" style="border-radius: 8px;" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="editRecurrence" style="font-weight: 600; margin-bottom: 0.5rem;">Recurrence:</label>
                        <select id="editRecurrence" name="editRecurrence" class="form-control" style="border-radius: 8px;">
                            <option value="none">None</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>

                    <div id="editCustomRecurrenceOptions" style="display: none; gap: 1rem;">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="editCustomInterval" style="font-weight: 600; margin-bottom: 0.5rem;">Interval:</label>
                                <input type="number" id="editCustomInterval" name="editCustomInterval" min="1" class="form-control" 
                                    style="border-radius: 8px;" placeholder="Every X days/weeks/months" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="editCustomFrequency" style="font-weight: 600; margin-bottom: 0.5rem;">Frequency:</label>
                                <select id="editCustomFrequency" name="editCustomFrequency" class="form-control" style="border-radius: 8px;">
                                    <option value="">Select Frequency</option>
                                    <option value="daily">Days</option>
                                    <option value="weekly">Weeks</option>
                                    <option value="monthly">Months</option>
                                    <option value="yearly">Years</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button class="btn blue-btn btn-lg mt-3" style="border-radius: 8px;">
                        Update Event
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include the AJAX handler file -->
<script src="<?php echo plugin_dir_url(dirname(__FILE__)) ; ?>ajax/calendar_ajax_function.js"></script>