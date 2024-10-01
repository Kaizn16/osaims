@extends('layouts.app')

@section('content')
<div class="main-content">
    <header class="header">
        <strong class="title">{{ isset($user) ? 'Edit User' : 'Create User' }}</strong>
    </header>

    <div class="form-wrapper">
        <div class="form-container">
            <header class="form-header">
                <strong class="title">{{ isset($user) ? 'Edit User Form' : 'New User Form' }}</strong>
            </header>
            <form id="create-user-form" class="form-content" method="POST" action="{{ isset($user) ? route('user.update', $user->user_id) : route('user.store') }}">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="full_name">Full Name <p class="required">*</p></label>
                    <input type="text" name="full_name" id="full_name" 
                           value="{{ isset($user) ? $user->fullname : old('full_name') }}" 
                           placeholder="Full Name" />
                </div>

                <div class="form-group">
                    <label for="email">Email <p class="required">*</p></label>
                    <input type="text" name="email" id="email" 
                           value="{{ isset($user) ? $user->email : old('email') }}" 
                           placeholder="Email" autocomplete="email" />
                </div>

                <div class="form-group">
                    <label for="student_id" id="student-id-label">{{ isset($user) && $user->role == 'staff' ? 'Username' : 'Student ID' }} <p class="required">*</p></label>
                    <input type="text" name="student_id" id="student_id" 
                           value="{{ isset($user) ? $user->student_id : old('student_id') }}" 
                           placeholder="{{ isset($user) && $user->role == 'staff' ? 'Username' : 'Student ID' }}" />
                </div>

                <div class="form-group">
                    <label for="password">Password <p class="required">{{ isset($user) ? '' : '*' }}</p></label>
                    <input type="password" name="password" id="password" placeholder="Password" />
                    <span id="toggle-eye-icon">
                        <i class="fa-solid fa-eye icon" id="eye-open"></i>
                        <i class="fa-solid fa-eye-slash icon" id="eye-closed" style="display: none;"></i>
                    </span>
                </div>

                <div class="form-group" id="department-group" style="{{ isset($user) && $user->role == 'staff' ? 'display: none;' : '' }}">
                    <label for="department">Department <p class="required">*</p></label>
                    <select name="department" id="department">
                        <option selected disabled>Select Department</option>
                        @foreach ($Departments as $Department)
                            <option value="{{ $Department->department_id }}" {{ isset($user) && $user->department_id == $Department->department_id ? 'selected' : '' }}>
                                {{ $Department->department_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="course-group" style="{{ isset($user) && $user->role == 'staff' ? 'display: none;' : '' }}">
                    <label for="course">Course <p class="required">*</p></label>
                    <select name="course" id="course">
                        <option selected disabled>Select Course</option>
                        @foreach ($Courses as $Course)
                            <option value="{{ $Course->course_id }}" {{ isset($user) && $user->course_id == $Course->course_id ? 'selected' : '' }}>
                                {{ $Course->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="year-level-group">
                    <label for="year_level">Year Level <p class="required">*</p></label>
                    <select name="year_level" id="year_level">
                        <option selected disabled>Select Year Level</option>
                        @foreach ($YearLevels as $YearLevel)
                            <option value="{{ $YearLevel }}" {{ isset($user) && $user->year_level == $YearLevel ? 'selected' : '' }}>
                                {{ $YearLevel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="age">Age <p class="required">*</p></label>
                    <input type="number" name="age" id="age" placeholder="Age" min="0" step="1" 
                           value="{{ isset($user) ? $user->age : old('age') }}" 
                           oninput="this.value = Math.abs(this.value)">
                </div>

                <div class="form-group">
                    <label for="sex">Sex <p class="required">*</p></label>
                    <select name="sex" id="sex">
                        <option selected disabled>Select Sex</option>
                        @foreach ($Sex as $sexOption)
                            <option value="{{ $sexOption }}" {{ isset($user) && $user->sex == $sexOption ? 'selected' : '' }}>
                                {{ $sexOption }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="role">Role <p class="required">*</p></label>
                    <select name="role" id="role">
                        <option selected disabled>Select Role</option>
                        @foreach ($Roles as $Role)
                            <option value="{{ $Role->role_id }}" {{ isset($user) && $user->role_id == $Role->role_id ? 'selected' : '' }}>
                                {{ ucfirst($Role->role_type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </form>
            <div class="form-footer">
                <a href="{{ route('Users') }}">BACK</a>
                <button type="submit" id="submitUser">{{ isset($user) ? 'UPDATE' : 'ADD' }}</button>
            </div>
        </div>
    </div>

    <script>
        // ROUTES
        const getCourseRoute = "{{ route('get.courses', ':department_id') }}";

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

        document.getElementById('toggle-eye-icon').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');
            const toggleEyeIcon = document.getElementById('toggle-eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'inline';
                toggleEyeIcon.classList.add('active');
            } else {
                passwordInput.type = 'password';
                eyeOpen.style.display = 'inline';
                eyeClosed.style.display = 'none';
                toggleEyeIcon.classList.remove('active');
            }
        });

        function fetchCourses(departmentId, selectedCourseId = null) {
            const url = getCourseRoute.replace(':department_id', departmentId);

            fetch(url)
                .then(response => response.json())
                .then(courses => {
                    const courseSelect = document.getElementById('course');
                    courseSelect.innerHTML = '<option selected disabled>Select Course</option>';

                    courses.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course.course_id;
                        option.textContent = course.course_name;

                        if (selectedCourseId && course.course_id == selectedCourseId) {
                            option.selected = true;
                        }

                        courseSelect.appendChild(option);
                    });
                })
                .catch(error => showToast('error', 'Error fetching courses.'));
        }


        document.getElementById('department').addEventListener('change', function() {
            const departmentId = this.value;
            fetchCourses(departmentId);
        });

        window.onload = function() {
            const departmentSelect = document.getElementById('department');
            const selectedCourseId = "{{ isset($user) ? $user->course_id : null }}";

            if (departmentSelect.value) {
                fetchCourses(departmentSelect.value, selectedCourseId);
            }
        };

        document.getElementById('submitUser').addEventListener('click', function() {
            document.getElementById('create-user-form').submit();
        });

        document.getElementById('role').addEventListener('change', function() {
            const selectedRole = this.options[this.selectedIndex].text.toLowerCase();
            const departmentGroup = document.getElementById('department-group');
            const courseGroup = document.getElementById('course-group');
            const yearLevelGroup = document.getElementById('year-level-group');
            const studentIdLabel = document.getElementById('student-id-label');
            const studentIdInput = document.getElementById('student_id');

            if (selectedRole === 'staff') {
                departmentGroup.style.display = 'none';
                courseGroup.style.display = 'none';
                yearLevelGroup.style.display = 'none';

                studentIdLabel.textContent = 'Username';
                studentIdInput.placeholder = 'Username';
            } else {
                departmentGroup.style.display = '';
                courseGroup.style.display = '';
                yearLevelGroup.style.display = '';

                studentIdLabel.textContent = 'Student ID';
                studentIdInput.placeholder = 'Student ID';
            }
        });
    </script>
</div>
@endsection