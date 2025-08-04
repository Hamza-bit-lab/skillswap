@extends('user-side.layouts.app')

@section('title', 'SkillSwap - Edit Profile')

@section('content')
<div class="container-fluid profile-container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.profile.update') }}" method="POST" id="profile-form">
                        @csrf
                        @method('PUT')

                        

                        <!-- Basic Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', Auth::user()->name) }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" 
                                           class="form-control @error('username') is-invalid @enderror" 
                                           id="username" 
                                           name="username" 
                                           value="{{ old('username', Auth::user()->username) }}" 
                                           required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', Auth::user()->email) }}" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone', Auth::user()->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" 
                                           class="form-control @error('location') is-invalid @enderror" 
                                           id="location" 
                                           name="location" 
                                           value="{{ old('location', Auth::user()->location) }}">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Social Media Links -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="url" 
                                           class="form-control @error('website') is-invalid @enderror" 
                                           id="website" 
                                           name="website" 
                                           value="{{ old('website', Auth::user()->website) }}"
                                           placeholder="https://example.com">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">LinkedIn Profile</label>
                                    <input type="url" 
                                           class="form-control @error('linkedin') is-invalid @enderror" 
                                           id="linkedin" 
                                           name="linkedin" 
                                           value="{{ old('linkedin', Auth::user()->linkedin) }}"
                                           placeholder="https://linkedin.com/in/username">
                                    @error('linkedin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="github">GitHub Profile</label>
                                    <input type="url" 
                                           class="form-control @error('github') is-invalid @enderror" 
                                           id="github" 
                                           name="github" 
                                           value="{{ old('github', Auth::user()->github) }}"
                                           placeholder="https://github.com/username">
                                    @error('github')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter">Twitter Profile</label>
                                    <input type="url" 
                                           class="form-control @error('twitter') is-invalid @enderror" 
                                           id="twitter" 
                                           name="twitter" 
                                           value="{{ old('twitter', Auth::user()->twitter) }}"
                                           placeholder="https://twitter.com/username">
                                    @error('twitter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- About Me -->
                        <div class="form-group mt-4">
                            <label for="bio">About Me</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                      id="bio" 
                                      name="bio" 
                                      rows="4"
                                      placeholder="Tell us about yourself, your skills, and what you're looking to learn or teach...">{{ old('bio', Auth::user()->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{ route('user.profile') }}" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush

<style>
.profile-container {
    padding: 30px;
}
</style>
@endsection
