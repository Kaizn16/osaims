@extends('layouts.app')

@section('content')
<div class="main-content">
    <header class="header">
        <strong class="title">Users</strong>
        <span>Modify Users</span>
    </header>

    <div class="boxes users">
        <div class="box">
            <img src="{{ asset('assets/Images/Students.png') }}" alt="Icon">
            <span><div class="vertical-line"></div></span>
            <div class="info">
                <p>Students</p>
                <strong>
                    {{ $totalStudents ?? 0}}
                </strong>
            </div>
        </div>

        <div class="box">
            <img src="{{ asset('assets/Images/Staff.png') }}" alt="Icon">
            <span><div class="vertical-line"></div></span>
            <div class="info">
                <p>Staff</p>
                <strong>
                    {{ $totalStaff ?? 0}}
                </strong>
            </div>
        </div>
    </div>
    
    <div class="table-wrapper">
        <header class="header">
            <div class="filter">
                <div class="tabs">
                    <button class="active">Student Accounts</button>
                    <button>Staff</button>
                </div>
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass icon"></i>
                    <input type="text" placeholder="Search">
                </div>
            </div>
            <div class="header-button">
                <a href="{{ route('user.create') }}">
                    <i class="fa-solid fa-plus"></i>
                    New User
                </a>
            </div>
        </header>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr class="table-header">
                        <th>Name</th>
                        <th class="username-header">Username</th>
                        <th class="student-id-header">Student-ID</th>
                        <th>Email</th>
                        <th>
                            <i class="fa-solid fa-gears"></i>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-data">
                    <!-- Table data will be populated here -->
                </tbody>
            </table>
        
            <div class="pagination">
                <span class="pagination-info">
                    <p>Rows per page:</p> 
                    <select name="page_number">
                        <option selected>All</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </span>
                <span class="pagination-info-text"></span>
                <div class="pagination-actions">
                    <span class="back"><i class="fa-solid fa-chevron-left"></i></span>
                    <span class="next"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                showToast('success', "{{ session('success') }}");
            });
        </script>
    @endif

    <script type="text/javascript">
        function showToast(toastrType, toastrMessage) {
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            };

            switch (toastrType) {
                case 'success':
                    toastr.success(toastrMessage);
                    break;
                case 'error':
                    toastr.error(toastrMessage);
                    break;
                case 'warning':
                    toastr.warning(toastrMessage);
                    break;
                case 'info':
                default:
                    toastr.info(toastrMessage);
                    break;
            }
        }

        function DeleteModal(user_id) {
            Swal.fire({
                title: 'Are you sure you want to delete this user?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('user.delete', ':user_id') }}".replace(':user_id', user_id);
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);
                    const methodOverride = document.createElement('input');
                    methodOverride.type = 'hidden';
                    methodOverride.name = '_method';
                    methodOverride.value = 'DELETE';
                    form.appendChild(methodOverride);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        $(document).ready(function() {
            let currentRole = 'student'; // Default filter
            let searchQuery = '';        // Default search query
            let currentPage = 1;         // Default page
            let rowsPerPage = 10;        // Default rows per page
            let totalPages = 0;          // Total number of pages

            function fetchUsers() {
                $.ajax({
                    url: "{{ route('users.get') }}",
                    method: "GET",
                    data: {
                        role: currentRole,
                        search: searchQuery,
                        page: currentPage,
                        rowsPerPage: rowsPerPage
                    },
                    success: function(response) {
                        let tbody = $('.table-data');
                        tbody.empty();

                        // Clear previous headers
                        $('.table-header').empty();
                        let headerCells = `
                            <th>Name</th>
                            ${currentRole === 'student' ? '<th class="student-id-header">Student-ID</th>' : '<th class="username-header">Username</th>'}
                            <th>Email</th>
                            <th><i class="fa-solid fa-gears"></i></th>
                        `;
                        $('.table-header').append(headerCells);

                        if (response.data.length === 0) {
                            tbody.append(`
                                <tr>
                                    <td colspan="5">No users found.</td>
                                </tr>
                            `);
                            $('.pagination-info-text').text(`0 - 0 of ${response.total}`);
                            return;
                        }

                        response.data.forEach(function(user) {
                            const editURL = route('user.edit', user.user_id);
                            let studentIdCell = currentRole === 'student' ? `<td>${user.student_id}</td>` : '';
                            let usernameCell = currentRole === 'student' ? '' : `<td>${user.username}</td>`;

                            tbody.append(`
                                <tr>
                                    <td>${user.fullname}</td>
                                    ${usernameCell}
                                    ${studentIdCell}
                                    <td>${user.email}</td>
                                    <td>
                                        <div class="table-action">
                                            <button class="delete" onclick="DeleteModal(${user.user_id})">
                                                <i class="fa-solid fa-trash-can icon"></i>
                                            </button>
                                            <a href="${editURL}" class="edit">
                                                <i class="fa-solid fa-pen-to-square icon"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            `);
                        });

                        const start = response.from || 0;
                        const end = response.to || 0;
                        const total = response.total || 0;
                        totalPages = response.last_page;
                        $('.pagination-info-text').text(`${start} - ${end} of ${total}`);

                        $('.pagination-actions .back').prop('disabled', currentPage <= 1);
                        $('.pagination-actions .next').prop('disabled', currentPage >= totalPages);
                    },
                    error: function(error) {
                        console.error("Error fetching users:", error);
                    }
                });
            }

            $('.tabs button').click(function() {
                $('.tabs button').removeClass('active');
                $(this).addClass('active');

                currentRole = $(this).text().toLowerCase() === "student accounts" ? 'student' : 'staff';
                currentPage = 1; // Reset to page 1

                fetchUsers();
            });

            $('.search-container input').on('input', function() {
                searchQuery = $(this).val();
                currentPage = 1; // Reset to page 1
                fetchUsers();
            });

            $('.pagination-actions .back').click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    fetchUsers();
                }
            });

            $('.pagination-actions .next').click(function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    fetchUsers();
                }
            });

            $('select[name="page_number"]').change(function() {
                rowsPerPage = $(this).val() === "All" ? 2046 : $(this).val(); // Adjust for "All"
                currentPage = 1; // Reset to page 1
                fetchUsers();
            });

            // Initial fetch
            fetchUsers();
        });
    </script>
</div>
@endsection