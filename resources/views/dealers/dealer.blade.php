<div class="table-overlay" id="tableOverlay">

    <img src="{{ asset('icons/spinner.gif') }}" class="spinner-border" alt="Loading...">
</div>

<div class="table-responsive scrollbar" id="dealerTableDiv">
    <table class="table table-bordered table-striped fs-10 mb-0" id="dealerTable">
        <thead class="bg-200">

        <tr>
            <th data-sort-order="asc" class="text-900 sort align-middle py-2" data-column="dealer_id" data-sort="dealer_id" style="min-width:7rem">Dealer ID </th>
            <th data-sort-order="asc" class="text-900 sort align-middle" data-column="first_name" data-sort="first_name" style="min-width:8rem">First Name </th>
            <th data-sort-order="asc" class="text-900 sort align-middle" data-column="last_name" data-sort="last_name" style="min-width:8rem">Last Name</th>
            <th data-sort-order="asc" class="text-900 sort align-middle" data-column="email"  data-sort="email">Email</th>
            <th data-sort-order="asc" class="text-900 sort align-middle" data-column="phone" data-sort="phone" style="min-width:7rem">Phone</th>
            <th data-sort-order="asc" class="text-900 sort align-middle" data-column="last_login" data-sort="last_login" style="min-width:12rem" >Last
                Login</th>
            <th class="sort align-middle" data-sort="action" style="min-width:12rem">Action</th>
        </tr>
        </thead>
        <tbody class="list">
            @if (!empty($users) && count($users) > 0)
                @foreach ($users as $user)
                    <tr id="row_{{ $user['id'] }}">
                        <td class="text">{{ $user['id'] }}</td>
                        <td class="text">{{ $user['first_name'] }}</td>
                        <td class="text">{{ $user['last_name'] }}</td>
                        <td class="text">{{ $user['email'] }}</td>
                        <td class="text">{{ $user['office_phone'] }}</td>
                        <td class="text">2/27/2024 :Chrome 121</td>
                        <td class="align-middle status fs-0 pe-4">
                            <button class="btn btn-link p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Home">
                                <span class="text-900 fas fa-home"></span>
                            </button>
                            <a href="{{ route('dealer.edit', ['dealer' => $user['id']]) }}" class="btn btn-link p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <span class="text-900 fas fa-edit"></span>
                            </a>
                            <a href="" class="btn btn-link p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Location">
                                <span class="text-900 fa fa-map-marker"></span>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-link p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Dealer" onclick="deleteRecord('{{ $user['id'] }}','dealer')">
                                <span class="text-900 fa fa-trash"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">No User found.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Footer -->
    <div class="card-footer">
        <div class="row">
            <div class="col-10 pagination" data-table_id="dealerTableDiv">
                {{ $users->appends(request()->except('page'))->links() }}
            </div>

            <div class="col-2">
                <label>Paginaion</label>
                <form id="perPageForm" action="{{ route('home') }}" method="GET">
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
    document.querySelectorAll("#dealerTable th").forEach((th, index) => {
        th.addEventListener("click", () => {
            sortTable(index, 'dealerTable');
        });
    });

</script>
