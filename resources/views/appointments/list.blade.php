<div class="table-overlay" id="tableOverlay">
    <img src="{{ asset('icons/spinner.gif') }}" class="spinner-border" alt="Loading...">
</div>

<div class="table-responsive scrollbar" id="appointmentTableDiv">
    <table class="table table-bordered table-striped fs-10 mb-0" id="appointmentTable">
        <thead class="bg-200">

        <tr>
            <th data-sort-order="asc" class="text-900 sort align-middle py-2" data-column="received" data-sort="received" style="min-width:7rem">Received </th>
            <th data-sort-order="asc" class="text-900 sort align-middle" data-column="dealer_id" data-sort="dealer_id" style="min-width:8rem">Dealer </th>
            <th data-sort-order="asc" class="text-900 sort align-middle" data-column="location" data-sort="location" style="min-width:8rem">Location </th>
            <th data-sort-order="asc" class="text-900 sort align-middle" data-column="customer" data-sort="customer" style="min-width:8rem">Customer </th>
            <th data-sort-order="asc" class="text-900 sort align-middle" data-column="request_date" data-sort="request_date" style="min-width:8rem">Reques Date/Time </th>
            <th data-sort-order="asc" class="text-900 sort align-middle" data-column="request_services" data-sort="request_services" style="min-width:8rem">Requested Services</th>
            <th class="sort align-middle" data-sort="action" style="min-width:12rem">Action</th>
        </tr>
        </thead>
        <tbody class="list">
        @if (!empty($appointments) && count($appointments) > 0)
            @foreach ($appointments as $appointment)
                <tr id="row_{{ $appointment->id }}">
                    <td class="text">{{  date('n/j/Y, g:i a', strtotime($appointment->created_at)) }}</td>
                    <td class="text">{{ $appointment->dealer_id }}</td>
                    <td class="text">{{ !empty($appointment->location) ? '['.$appointment->location->id.'] '.$appointment->location->AddressLine1.', '.$appointment->location->LocationTitle : '' }}</td>
                    <td class="text">{{ $appointment->first_name.' '.$appointment->last_name }}</td>
                    <td class="text">{{ date('m/d/Y / h:i A', strtotime($appointment->request_datetime)) }}</td>
                    <td class="text">{{ $appointment->requested_services }}</td>
                    <td class="align-middle status fs-0 pe-4">
                        <a href="javascript:void(0)" class="btn btn-link p-0 toggle-details-btn" data-target="details-row-{{ $appointment->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Show Detail">
                            <span class="text-900 fas fa-info-circle"></span>
                        </a>
                    </td>
                </tr>
                <tr class="details-row" id="details-row-{{ $appointment->id }}" style="display: none;">
                    <td colspan="3" style="padding:1px">
                        <table>
                            <tr>
                                <td><span class="custom-label">First Name: </span></td>
                                <td>{{ $appointment->first_name }}</td>
                            </tr>
                            <tr>
                                <td><span class="custom-label">Last Name: </span></td>
                                <td>{{ $appointment->last_name }}</td>
                            </tr>
                            <tr>
                                <td><span class="custom-label">Zip Code: </span></td>
                                <td>62704</td>
                            </tr>
                            <tr>
                                <td><span class="custom-label">Phone: </span></td>
                                <td>{{ $appointment->phone }}</td>
                            </tr>
                            <tr>
                                <td><span class="custom-label">Email: </span></td>
                                <td>{{ $appointment->email }}</td>
                            </tr>
                            <tr>
                                <td><span class="custom-label">Preferred Contact Method: </span></td>
                                <td>{{ $appointment->preferred_contact_method }}</td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="4" style="padding:1px">
                        <table>
                            <tr>
                                <td><span class="custom-label">Car: </span></td>
                                <td>{{ $appointment->vehicle_year }} {{ $appointment->vehicle_make }} {{ $appointment->vehicle_model }}  {{ $appointment->vehicle_option }}</td>
                            </tr>
                            <tr>
                                <td><span class="custom-label">Drop-Off: </span></td>
                                <td>{{ $appointment->drop_off }}</td>
                            </tr>
                            <tr>
                                <td><span class="custom-label">Requested Services: </span></td>
                                <td>{{ $appointment->requested_services }}</td>
                            </tr>
                            <tr>
                                <td><span class="custom-label">Comments: </span></td>
                                <td>{{ $appointment->comments }}</td>
                            </tr>
                            <tr>
                                <td><span class="custom-label">Store Contacts: </span></td>
                                <td>carxspringfield@comcast.net;carx750linton@gmail.com</td>
                            </tr>
                            <tr>
                                <td><span class="custom-label">PPC: </span></td>
                                <td>No</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center">No Appointment found.</td>
            </tr>
        @endif
        </tbody>
    </table>

    <!-- Footer -->
    <div class="card-footer">
        <div class="row">
            <div class="col-10 pagination" data-table_id="appointmentTableDiv">
                {{ $appointments->appends(request()->except('page'))->links() }}
            </div>

            <div class="col-2">
                <label>Paginaion</label>
                <form id="perPageForm" action="{{ route('coupon.index') }}" method="GET">
                    <select class="form-select" name="per_page" onchange="this.form.submit()">
                        <option value="10" {{ Request::input('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ Request::input('per_page') == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ Request::input('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </form>

            </div>
        </div>
    </div>

</div>

<script>

    // Call the sortTable function after DOMContentLoaded
    document.querySelectorAll("#appointmentTable th").forEach((th, index) => {
        th.addEventListener("click", () => {
            sortTable(index, 'appointmentTable');
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Function to toggle details row visibility
        function toggleDetailsRow(button) {
            const targetRowId = button.getAttribute('data-target');
            const detailsRow = document.getElementById(targetRowId);

            if (detailsRow) {
                detailsRow.style.display = (detailsRow.style.display === 'table-row') ? 'none' : 'table-row';
            }
        }

        // Bind click event listener to toggle buttons
        function bindToggleButtons() {
            const toggleDetailButtons = document.querySelectorAll('.toggle-details-btn');

            toggleDetailButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    toggleDetailsRow(button);
                });
            });
        }

        // Initial binding of toggle buttons
        bindToggleButtons();

        // Re-bind toggle buttons after AJAX content is loaded
        document.addEventListener('ajaxContentLoaded', function() {
            bindToggleButtons();
        });
    });

    // After AJAX content is loaded
    document.dispatchEvent(new Event('ajaxContentLoaded'));


    /*
    document.addEventListener('DOMContentLoaded', function() {
        const toggleDetailButtons = document.querySelectorAll('.toggle-details-btn');

        toggleDetailButtons.forEach(function(button) {
            button.addEventListener('click', function() { alert('i am here');
                // Get the target details row ID from the button's data attribute
                const targetRowId = button.getAttribute('data-target');

                // Get the corresponding details row
                const detailsRow = document.getElementById(targetRowId);
alert(detailsRow);
                // Toggle visibility of details row
                if (detailsRow.style.display === 'table-row') {
                    detailsRow.style.display = 'none';
                } else {
                    detailsRow.style.display = 'table-row';
                }
            });
        });
    });*/



</script>
