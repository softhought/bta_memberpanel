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
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #e6f4e6;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    /* Make the image a label target */
    .profile-img-label {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
        cursor: pointer;
    }

    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        pointer-events: none;
    }

    #profileInput {
        display: none;
    }

    .change-image-btn {
        position: absolute;
        bottom: 6px;
        left: 50%;
        transform: translateX(-50%) scale(0);
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
        opacity: 0;
        transition: transform 0.3s ease, opacity 0.3s ease;
        pointer-events: none;
        /* Prevent icon from blocking click */
    }

    .profile-img-label:hover .change-image-btn {
        opacity: 1;
        transform: translateX(-50%) scale(1.15);
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
        /* color: #1a8811; */
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
            if (!empty($member->member_portal_profile_picture)) {
                $profileUrl = asset($member->member_portal_profile_picture);
            } elseif (!empty($member->profile_picture)) {
                $profileUrl = "https://btaportal.in/backend/app/uploads/profile/{$member->profile_picture}";
            }
        @endphp

        <div class="profile-img-container">
            <label for="profileInput" class="profile-img-label">
                <img src="{{ $profileUrl }}" class="profile-img" alt="{{ $member->profile_picture }}">
                <div class="change-image-btn"><i class="fas fa-camera"></i></div>
            </label>
            <form method="POST" enctype="multipart/form-data" id="profileImageForm">
                @csrf
                <input type="file" name="profile_picture" id="profileInput" accept="image/*">
            </form>
        </div>

        <div class="profile-info">
            <h1 class="profile-name">{{ ucwords(strtolower($member->member_fname . ' ' . $member->member_lname)) }}</h1>
            <p class="profile-subtitle">{{ $member->address_one }}</p>
            <div class="member-code">{{ $member->member_code }}</div>
        </div>
    </div>

    <div class="profile-details position-relative">
        <h3 class="section-title d-flex justify-content-between align-items-center">
            Personal Information
            <a href="{{ url('member/profile') }}" class="edit-icon-top" style="color: white;"><i
                    class="fas fa-edit"></i></a>
        </h3>
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
                        <span>Valid Upto: {{ $endDate }}</span>
                    </div>
                    <div class="program-status {{ $statusClass }}">{{ $statusText }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#profileInput').on('change', function() {
            $('#profileImageForm').trigger('submit');
        });

        ajaxCall('profileImageForm', 'profileUpload', function(response) {
            if (response.message !== 'Profile picture updated successfully.') {
                showToast(response.message, 'error');
                return;
            }

            showToast(response.message);
            setTimeout(function() {
                location.reload();
            }, 1500);
        });
    });
</script>
