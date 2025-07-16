@extends('backend.admin.includes.admin_layout')
@section('content')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class=" mb-2" style="text-align:center">
                        <h3>Learner List</h3>
                    </div>
                    <div class="mt-3">
                        @if (session('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Failed!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="btn-close"></button>
                        </div>
                        @endif
                        <div id="success"></div>
                        <div id="failed"></div>
                    </div>
                    <div style="text-align: right" class="mt-3">

                        <a href=""><button type="button" class="btn btn-warning btn-xs"><i class="fa-solid fa-download"></i> Excel</button></a>
                        <a href="{{route('admin.learner.pdf')}}" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa-regular fa-file-pdf"></i>PDF</button></a>

                    </div>
                    <div class="table-responsive" id="print_data">
                        <table id="dataTableExample" class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="">SL</th>
                                    <th style="">Photo</th>
                                    <th style="">Name</th>
                                    <th style="">Phone</th>
                                    <th style="">Country</th>
                                    <th style="">Email</th>
                                    <th style="">Gender</th>
                                    <!-- <th style="">Password</th>
                                    <th style="">Learner Type</th>
                                    <th style="">Highest Degree</th>
                                    <th style="">Position</th>
                                    <th style="">Company Name</th>
                                    <th style="">Experience</th>
                                    <th style="">Photo</th>
                                    <th style="">Latest CV</th>
                                    <th style="">Training Details</th>
                                    <th style="">Achievements</th>
                                    <th style="">Research Paper</th>
                                    <th style="">Present Address</th>
                                    <th style="">Permanent Address</th>
                                    <th style="">Country Visited</th>
                                    <th style="">Bio</th> -->
                                    <th style="width:15%">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['learner_list'] as $key => $single_learner)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        <img src="{{ asset($single_learner->photo ? $single_learner->photo : 'backend_assets/images/user-dummy.png') }}"
                                            alt="" loading="lazy" style="width:1000px">
                                    </td>
                                    <td> {{$single_learner -> name}} </td>
                                    <td> {{$single_learner -> phone}} </td>
                                    <td> {{$single_learner -> country }} </td>
                                    <td> {{$single_learner -> email}} </td>
                                    <td> {{$single_learner -> gender}} </td>


                                    <td>
                                        <a href=""
                                            class="btn btn-success btn-icon" href=""><i
                                                class="fa-solid fa-edit"></i></a>


                                        <a class="btn btn-danger btn-icon" data-delete="{{$single_learner->id}}"
                                            id="delete"><i class="fa-solid fa-trash"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).on('click', '#delete', function() {
        if (confirm('Are You Sure ?')) {
            let id = $(this).attr('data-delete');
            let row = $(this).closest('tr');
            $.ajax({
                url: '/admin/link/delete/' + id,
                success: function(data) {
                    var data_object = JSON.parse(data);
                    if (data_object.status == 'SUCCESS') {
                        row.remove();
                        $('#Table tbody tr').each(function(index) {
                            $(this).find('td:first').text(index + 1);
                        });
                        $('#success').css('display', 'block');
                        $('#success').html(
                            '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success! </strong>' +
                            data_object.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>'
                        );
                    } else {
                        $('#failed').html('display', 'block');
                        $('#failed').html(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed! </strong>' +
                            data_object.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>'
                        );
                    }

                }
            });
        }
    });
</script>
@endpush