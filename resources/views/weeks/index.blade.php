@extends('tablar::page')

@section('title')
    Weeks
@endsection

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        List
                    </div>
                    <h2 class="page-title">
                        {{ __('Week ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('weeks.create') }}" class="btn btn-primary d-none d-sm-inline-block texto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-pulse" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Create
                        </a>
                        <a href="{{ route('weeks.create') }}" class="btn btn-primary d-sm-none btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-pulse" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        @php
            function getContrastColor($hexColor) {
                $r = hexdec(substr($hexColor, 1, 2));
                $g = hexdec(substr($hexColor, 3, 2));
                $b = hexdec(substr($hexColor, 5, 2));
                $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
                return $luminance > 0.5 ? '#000000' : '#FFFFFF';
            }
        @endphp
        <div class="container-xl">
            @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
            @endif
            <ul class="nav nav-tabs" id="weeksTabs" role="tablist">
                @foreach($groupedWeeks as $weekNumber => $days)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="week-{{ $weekNumber }}-tab" data-bs-toggle="tab" href="#week-{{ $weekNumber }}" role="tab" aria-controls="week-{{ $weekNumber }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            Week {{ $weekNumber }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content row row-deck row-cards" id="weeksTabsContent">
                @foreach($groupedWeeks as $weekNumber => $days)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="week-{{ $weekNumber }}" role="tabpanel" aria-labelledby="week-{{ $weekNumber }}-tab col-12">
                        <ul class="nav nav-pills mb-3" id="daysTabs-{{ $weekNumber }}" role="tablist">
                            @foreach($days as $day => $records)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="day-{{ $weekNumber }}-{{ $day }}-tab" data-bs-toggle="pill" href="#day-{{ $weekNumber }}-{{ $day }}" role="tab" aria-controls="day-{{ $weekNumber }}-{{ $day }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $day }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content card" id="daysTabsContent-{{ $weekNumber }}">
                            @foreach($days as $day => $records)
                                <div class="tab-pane fade  {{ $loop->first ? 'show active' : '' }}" id="day-{{ $weekNumber }}-{{ $day }}" role="tabpanel" aria-labelledby="day-{{ $weekNumber }}-{{ $day }}-tab card-body border-bottom py-3 table-responsive">
                                    <table style="margin-top: 55px;" id="search-weeks" class="table table-vcenter datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-1"><a class="table-header">No.</a></th>
                                                <th><a class="table-header">Customer Name</a></th>
                                                <th><a class="table-header">Yacht Name</a></th>
                                                <th><a class="table-header">Location</a></th>
                                                <th><a class="table-header">Email</a></th>
                                                <th><a class="table-header">Color</a></th>
                                                <th class="w-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($records as $index => $week)
                                                <tr style="background-color: {{ $week->color }}; color: {{ getContrastColor($week->color) }}">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $week->customer_name }}</td>
                                                    <td>{{ $week->yacht_name }}</td>
                                                    <td>{{ $week->location }}</td>
                                                    <td>{{ $week->email }}</td>
                                                    <td>{{ $week->color }}</td>
                                                    <td>
                                                        <div class="btn-list flex-nowrap">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                                    Actions
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="{{ route('weeks.show',$week->id) }}">
                                                                        View
                                                                    </a>
                                                                    <a class="dropdown-item" href="{{ route('weeks.edit',$week->id) }}">
                                                                        Edit
                                                                    </a>
                                                                    <form action="{{ route('weeks.destroy',$week->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" onclick="if(!confirm('Do you Want to Proceed?')){return false;}" class="dropdown-item text-red"><i class="fa fa-fw fa-trash"></i>
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">No Data Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script>
        $(document).ready(function () {
            new DataTable('#search-weeks', {
                responsive: true,
                autoWidth: false,
                language: {
                    searchPlaceholder: "Search..."
                }
            });
        });
    </script>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
        .texto{
            font-family: 'Poppins', sans-serif;
        }
        .table-header {
            font-weight: bold;
            cursor: pointer;
            font-size: 11px;
        }
        div.dataTables_length label {
            display: none;
            visibility: hidden;
        }
        div.dataTables_filter label {
            left: 20;
            color: #8b1a1a00;
            width: 100%;
            margin-top: -12px;
        }
        .dataTables_filter input {
            font-family: 'Poppins', sans-serif;
            width: 100%;
            height: 39px;
            font-size: 14px;
            background: #ffffff;
            border-radius: 4px;
            text-indent: 10px;
        }
        div.dataTables_paginate {
            font-family: 'Poppins', sans-serif;
            margin-top: 20px;
        }
        div.dataTables_info {
            display: none;
        }
    </style>
@endsection

<style>
    #full-page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(255, 255, 255);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }
    .spinner {
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top: 4px solid #244062;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<script>
    window.addEventListener('load', function () {
        document.getElementById('full-page-loader').style.display = 'none';
    });
</script>
<script>
    function toggleAnswer(id) {
        var answer = document.getElementById(id);
        answer.classList.toggle('hidden');
    }
</script>
