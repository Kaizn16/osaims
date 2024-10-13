@extends('layouts.main')

@section('landing-page-content')
    <section class="register-organization-container">
        <header class="header">
            <h1>Register your organization</h1>
        </header>
        <div class="form-container">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group-row">
                    <div class="form-group-col">
                        <div class="form-group">
                            <label for="organization_name">Organization Name</label>
                            <input type="text" name="organization_name" id="organization_name"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="description" id="description" name="description"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group-col">
                        <div class="form-group">
                            <label for="date_established">Date Established</label>
                            <input type="date" name="date_established" id="date_established"/>
                        </div>
                        <div class="form-group">
                            <label for="adviser">Adviser</label>
                            <input type="text" name="adviser" id="adviser"/>
                        </div>
                        <div class="form-group">
                            <label for="vice_pres_internal">V-President Internal</label>
                            <input type="text" name="vice_pres_internal" id="vice_pres_internal"/>
                        </div>
                    </div>

                    <div class="form-group-col">
                        <div class="form-group">
                            <label for="departmental">Departmental</label>
                            <select name="departmental" id="departmental">
                                <option selected disabled>N/A</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="adviser">President</label>
                            <input type="text" name="adviser" id="adviser"/>
                        </div>
                        <div class="form-group">
                            <label for="vice_pres_external">V-President External</label>
                            <input type="text" name="vice_pres_external" id="vice_pres_external"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="is_national">National</label>
                        <input type="checkbox" name="is_national" id="is_national"/>
                    </div>
                    
                </div>

                <div class="form-group-col">

                </div>
            </form>
        </div>
    </section>
@endsection