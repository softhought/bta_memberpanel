<style>
    .profile-container {
        padding: 0 15px;
        min-height: 800px;
    }

    .profile-header {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-img-container {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #e6f4e6;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info {
        flex-grow: 1;
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: #15222f;
        margin-bottom: 5px;
    }

    .profile-subtitle {
        color: #15222f;
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .member-code {
        background: #eaf4e6;
        color: #10370c;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .profile-details {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 25px;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1a8811;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e0e0e0;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .detail-card {
        display: flex;
        align-items: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .detail-icon {
        width: 40px;
        height: 40px;
        background: #e6f4e6;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: #1a8811;
        flex-shrink: 0;
    }

    .detail-content {
        flex-grow: 1;
    }

    .detail-label {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 4px;
    }

    .detail-value {
        font-weight: 500;
        color: #2c3e50;
    }

    .programs-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 10px;
    }

    .program-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 15px;
    }

    .program-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid #1a8811;
    }

    .program-card.completed {
        border-left-color: #6c757d;
    }

    .program-title {
        font-weight: 600;
        font-size: 1.1rem;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .program-group {
        font-size: 0.85rem;
        color: #438601;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .program-meta {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
    }

    .program-status {
        font-size: 0.85rem;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    .status-active {
        background-color: rgba(26, 136, 17, 0.15);
        color: #1a8811;
    }

    .status-completed {
        background-color: #f8d7da;
        color: #721c24;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }

        .profile-img-container {
            margin-right: 0;
            margin-bottom: 15px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    use Carbon\Carbon;
@endphp

<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        @php
            $profileUrl = 'https://www.stephan-academy.com/content/avatars/avatar_lg.png';
            if (!empty($member->profile_picture)) {
                $profileUrl = "http://btaportal.in/backend/app/uploads/profile/{$member->profile_picture}";
            }
        @endphp

        <div class="profile-img-container">
            <img src="{{ $profileUrl }}" class="profile-img" alt="{{ $member->profile_pictur }}">
        </div>

        <div class="profile-info">
            <h1 class="profile-name">{{ ucwords(strtolower($member->member_fname . ' ' . $member->member_lname)) }}</h1>
            <p class="profile-subtitle">Student at {{ $member->school }}</p>
            <div class="member-code">{{ $member->member_code }}</div>
        </div>
    </div>

    <div class="profile-details">
        <h3 class="section-title">Personal Information</h3>
        <div class="detail-grid">
            <div class="detail-card">
                <div class="detail-icon"><i class="fas fa-birthday-cake"></i></div>
                <div class="detail-content">
                    <div class="detail-label">Date of Birth</div>
                    <div class="detail-value">{{ Carbon::parse($member->date_of_birth)->format('d-M-Y') }}</div>
                </div>
            </div>
            <div class="detail-card">
                <div class="detail-icon"><i class="fas fa-venus-mars"></i></div>
                <div class="detail-content">
                    <div class="detail-label">Gender</div>
                    <div class="detail-value">{{ $member->gender == 'M' ? 'Male' : 'Female' }}</div>
                </div>
            </div>
            <div class="detail-card">
                <div class="detail-icon"><i class="fas fa-mobile-alt"></i></div>
                <div class="detail-content">
                    <div class="detail-label">Mobile</div>
                    <div class="detail-value">{{ $member->primary_mobile }}</div>
                </div>
            </div>
            <div class="detail-card">
                <div class="detail-icon"><i class="fas fa-envelope"></i></div>
                <div class="detail-content">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">{{ $member->primary_email }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="programs-section">
        <h3 class="section-title">Program Enrollments</h3>
        <div class="program-grid">
            @foreach ($member->programEnrollment as $enroll)
                @php
                    $programName = $enroll->program->programme_name ?? 'N/A';
                    $groupName = $enroll->group->programme_group ?? 'N/A';
                    $startDate = Carbon::parse($enroll->enrollment_start_date)->format('d-M-Y');
                    $endDate = Carbon::parse($enroll->enrollment_end_date)->format('d-M-Y');
                    $statusClass = $enroll->is_active === 'Y' ? 'status-active' : 'status-completed';
                    $statusText = $enroll->is_active === 'Y' ? 'Active' : 'Inactive';
                @endphp
                <div class="program-card {{ $statusClass == 'status-completed' ? 'completed' : '' }}">
                    <div class="program-title">{{ $programName }}</div>
                    <div class="program-group">Group: {{ $groupName }}</div>
                    <div class="program-meta">
                        <span>From: {{ $startDate }}</span>
                        <span>To: {{ $endDate }}</span>
                    </div>
                    <div class="program-status {{ $statusClass }}">{{ $statusText }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>
