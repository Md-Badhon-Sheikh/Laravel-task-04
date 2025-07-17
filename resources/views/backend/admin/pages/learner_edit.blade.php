@extends('backend.admin.includes.admin_layout')
@push('css')
@endpush
@section('content')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class=" text-center mb-2">Learner Add</h3>
                    @if (session('success'))
                    <div style="width:100%" class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong> Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="btn-close"></button>
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Failed!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="btn-close"></button>
                    </div>
                    @endif
                    <form action="{{route('admin.learner.edit', $data['learner']->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="form-label"> Name *</label>
                                <input type="text" value="{{$data['learner']->name}}" class="form-control" name="name"
                                    placeholder="Enter Learner Name" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Phone *</label>
                                <input type="text" value="{{$data['learner']->phone}}" name="phone" class="form-control"
                                    placeholder="Enter Phone Number" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Country *</label>
                                <input type="text" value="{{$data['learner']->country}}" name="country" class="form-control"
                                    placeholder="Enter Country" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Email</label>
                                <input type="email" value="{{$data['learner']->email}}" name="email" placeholder="Enter Email" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Password *</label>
                                <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="" class="form-label">Gender</label>
                                <select class="form-select js-example-basic-single" name="gender" id="">
                                    <option value="{{$data['learner']->gender}}">Select </option>
                                    <option value="male" {{ (old('gender', $data['learner']->gender) == 'male') ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ (old('gender', $data['learner']->gender) == 'female') ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="" class="form-label">Learner Type *</label>
                                <select name="learner_type" class="form-select js-example-basic-single"
                                    id="" required>
                                    <option value="">Select Type</option>
                                    <option value="Student" {{ (old('learner_type', $data['learner']->learner_type) == 'Student') ? 'selected' : '' }}>Student</option>
                                    <option value="Job" {{ (old('learner_type', $data['learner']->learner_type) == 'Job') ? 'selected' : '' }}>Job</option>
                                    <option value="Business" {{ (old('learner_type', $data['learner']->learner_type) == 'Business') ? 'selected' : '' }}>Business</option>
                                    <option value="Others" {{ (old('learner_type', $data['learner']->learner_type) == 'Others') ? 'selected' : '' }}>Others</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="" class="form-label"> Highest Degree</label>
                                <input type="text" class="form-control" value="{{$data['learner']->highest_degree}}" name="highest_degree"
                                    placeholder="Enter Highest Degree">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="" class="form-label"> Position</label>
                                <input type="text" value="{{$data['learner']->position}}" class="form-control" name="position"
                                    placeholder="Enter Position">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="" class="form-label"> Company Name</label>
                                <input type="text" class="form-control" value="{{$data['learner']->company_name}}" name="company_name"
                                    placeholder="Enter Company Name">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="" class="form-label"> Year of Experience</label>
                                <input type="number" value="{{$data['learner']->experience_year}}" class="form-control" name="experience_year" step="any"
                                    placeholder="Enter Year of Experience">
                            </div>


                            <div class="col-md-3 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Your Photo</label>
                                    <input name="photo" class="form-control" type="file" id="imgPreview"
                                        onchange="readpicture(this, '#imgPreviewId');">
                                </div>
                                <div class="text-center">
                                    <img id="imgPreviewId" onclick="image_upload()"
                                        src="{{ asset($data['learner']->photo ? $data['learner']->photo : 'backend_assets/images/uploads_preview.png') }}">
                                </div>
                            </div>


                            <div class="col-md-3 mb-3">
                                <label class="form-label">Your CV</label>
                                <input name="cv" class="form-control" type="file" accept="application/pdf">

                                @if (!empty($data['learner']->latest_cv))
                                <a href="{{ asset($data['learner']->latest_cv) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="fa fa-file-pdf"></i> View Existing CV
                                </a>
                                @endif
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="issue_date" class="form-label">Training Details</label>
                                <textarea class="form-control" name="training_details" rows="3" placeholder="Enter Training Details">{{ old('training_details', $data['learner']->training_details) }}</textarea>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="issue_date" class="form-label">Achievements</label>
                                <textarea class="form-control" name="achievements" rows="3" placeholder="Enter Achievements">{{ old('achievements', $data['learner']->achievements) }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="issue_date" class="form-label">Research Paper</label>
                                <textarea class="form-control" name="research_paper" rows="3" placeholder="Enter Research Paper">{{ old('research_paper', $data['learner']->research_paper) }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="issue_date" class="form-label">Present Address</label>
                                <textarea class="form-control" name="present_address" rows="3" placeholder="Enter Present Address">{{ old('present_address', $data['learner']->present_address) }}</textarea>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="issue_date" class="form-label">Permanent Address</label>
                                <textarea class="form-control" name="parmanent_address" rows="3" placeholder="Enter Permanent Address">{{ old('parmanent_address', $data['learner']->parmanent_address) }}</textarea>

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="issue_date" class="form-label">Country Visited</label>
                                <textarea class="form-control" name="country_visited" rows="3" placeholder="Enter The Country Visited">{{ old('country_visited', $data['learner']->country_visited) }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="issue_date" class="form-label">Bio *</label>
                                <textarea class="form-control" name="bio" rows="3" placeholder="Enter Bio" required>{{ old('bio', $data['learner']->bio) }}</textarea>
                            </div>

                        </div>
                        <div class="text-center mt-2">
                            <button class="btn btn-xs btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function image_upload() {

        $('#imgPreview').trigger('click');
    }

    function readpicture(input, preview_id) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(preview_id)
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }

    }
</script>
@endpush