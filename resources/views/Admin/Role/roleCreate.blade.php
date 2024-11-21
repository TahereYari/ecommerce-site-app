@extends('layout.admin')

@section('content')


<section class="middle">
            
    <div class="form" >
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <div class="login-form box-1">
                    <h2 class="form-title text-center" id="form-access">Add New Role</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
                    <form action="{{ route('role_insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                
                                    <input type="text" class="form-control" id="nameOfRol" name="name" required placeholder="role name..">
                                </div>
                            
                                

                                <div class="container-m">
                                    <div class="custom-combobox-container">
                                        <div class="custom-combobox" onclick="showOptions(this)">
                                            <input type="text" placeholder="Permissions" id="inputCheckbox" readonly><i class='bx bx-chevron-down down'></i>
                                            
                                        </div>
                                        <div class="options-container" id="divOptions" onmouseleave="hideOptions(this)">
                                            @foreach ($permissions as $permission)
                                            <label for="{{ $permission->name }}">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="{{ $permission->id }}" onchange="updateInputCheckbox(this)" > 
                                                <span class="permission-label" data-en="{{ $permission->name }}" data-fa="{{ $permission->label }}">
                                                    {{ app()->getLocale() == 'fa' ? $permission->label : $permission->name }}
                                                 </span>
                                            </label>

                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="submit" class="btn btn-block btn-theme btn-form">Submit</button>
                            </form>
                </div>
            </div>
        </div>
    </div>
    

    <canvas id="chart" style="display: none;"></canvas>
   
</section>


@endsection