<!DOCTYPE html>
<html>

<head>
    <title>Important Links PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            border-collapse: collapse;
            /* width: 100%; */
            /* margin-top: 15px; */
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    
    </style>
</head>

<body>
    <h2>Important Links List</h2>
    <table>
        <thead>
            <tr>
                <th style="">SL</th>
                <th style="">Name</th>
                <th style="">Phone</th>
                <th style="">Country</th>
                <th style="">Email</th>
                <th style="">Gender</th>
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
                <th style="">Bio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['learner_list'] as $key => $single_learner)
            <tr>
                <td>{{$key +1 }}</td>
                <td>{{$single_learner->name }}</td>
                <td>{{$single_learner->phone }}</td>
                <td>{{$single_learner->country }}</td>
                <td>{{$single_learner->email }}</td>
                <td>{{$single_learner->gender }}</td>
                <td>{{$single_learner->learner_type }}</td>
                <td>{{$single_learner->highest_degree }}</td>
                <td>{{$single_learner->position }}</td>
                <td>{{$single_learner->company_name }}</td>
                <td>{{$single_learner->experience_year}}</td>
                <td>
                    <img src="{{ asset($single_learner->photo ? $single_learner->photo : 'backend_assets/images/user-dummy.png') }}"
                        alt="" loading="lazy">
                </td>
                <td>{{$single_learner-> latest_cv}}</td>
                <td>{{$single_learner->training_details }}</td>
                <td>{{$single_learner->achievements}}</td>
                <td>{{$single_learner->research_paper}}</td>
                <td>{{$single_learner->present_address}}</td>
                <td>{{$single_learner->parmanent_address}}</td>
                <td>{{$single_learner->country_visited }}</td>
                <td>{{$single_learner->bio}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>