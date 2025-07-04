{{-- filepath: c:\Users\casma\idSoft\resources\views\citizen_registration.blade.php --}}

<x-app-layout>
    <div class="container mx-auto mt-10 max-w-3xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-5 text-center text-gray-800">Citizen Registration Form</h1>
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('citizen.preview') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
                <input type="text" name="surname" id="surname" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="other_names" class="block text-sm font-medium text-gray-700">Other Names</label>
                <input type="text" name="other_names" id="other_names" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="hometown" class="block text-sm font-medium text-gray-700">Hometown</label>
                <input type="text" name="hometown" id="hometown" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="address" id="address" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="mb-4">
                <label for="contact_info" class="block text-sm font-medium text-gray-700">Contact Info (Phone Number)</label>
                <input type="text" name="contact_info" id="contact_info" class="border rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            {{-- Photo Upload / Camera Capture --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Photo</label>
                <div class="flex flex-col items-center gap-2">
                    <video id="camera" width="200" height="150" autoplay playsinline class="rounded border"></video>
                    <canvas id="snapshot" width="200" height="150" class="hidden"></canvas>
                    <img id="preview" src="#" alt="Preview" class="hidden rounded border" width="200" height="150">
                    <div class="flex gap-2">
                        <button type="button" id="startCamera" class="bg-blue-500 text-white px-2 py-1 rounded">Start Camera</button>
                        <button type="button" id="takePhoto" class="bg-green-500 text-white px-2 py-1 rounded" disabled>Take Photo</button>
                        <button type="button" id="retakePhoto" class="bg-yellow-500 text-white px-2 py-1 rounded hidden">Retake</button>
                    </div>
                    <input type="file" name="photo" id="photo" accept="image/*" class="hidden" required>
                    <span class="text-xs text-gray-500">Or <label for="photo" class="underline cursor-pointer text-blue-600">upload from device</label></span>
                </div>
            </div>
            {{-- Gender --}}
            <div class="mb-4">
                <label for="gender" class="block text-gray-700">Gender</label>
                <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            {{-- NIN --}}
            <div class="mb-4">
                <label for="nin" class="block text-gray-700">National Identification Number (NIN)</label>
                <input type="text" name="nin" id="nin" value="{{ old('nin') }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Preview</button>
        </form>
    </div>
<script>
    let stream;
    const camera = document.getElementById('camera');
    const snapshot = document.getElementById('snapshot');
    const preview = document.getElementById('preview');
    const startBtn = document.getElementById('startCamera');
    const takeBtn = document.getElementById('takePhoto');
    const retakeBtn = document.getElementById('retakePhoto');
    const fileInput = document.getElementById('photo');

    // Start camera
    startBtn.onclick = async function() {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            camera.srcObject = stream;
            camera.classList.remove('hidden');
            takeBtn.disabled = false;
            retakeBtn.classList.add('hidden');
            preview.classList.add('hidden');
            snapshot.classList.add('hidden');
        } else {
            alert('Camera not supported on this device/browser.');
        }
    };

    // Take photo
    takeBtn.onclick = function() {
        snapshot.getContext('2d').drawImage(camera, 0, 0, snapshot.width, snapshot.height);
        snapshot.classList.remove('hidden');
        preview.src = snapshot.toDataURL('image/png');
        preview.classList.remove('hidden');
        camera.classList.add('hidden');
        takeBtn.disabled = true;
        retakeBtn.classList.remove('hidden');

        // Convert canvas to blob and set as file input
        snapshot.toBlob(function(blob) {
            const file = new File([blob], "photo.png", { type: "image/png" });
            // Create a DataTransfer to set the file input
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;
        }, 'image/png');
    };

    // Retake photo
    retakeBtn.onclick = function() {
        camera.classList.remove('hidden');
        preview.classList.add('hidden');
        snapshot.classList.add('hidden');
        takeBtn.disabled = false;
        retakeBtn.classList.add('hidden');
        fileInput.value = '';
    };

    // If user selects file manually, show preview
    fileInput.onchange = function(e) {
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                preview.src = ev.target.result;
                preview.classList.remove('hidden');
                camera.classList.add('hidden');
                snapshot.classList.add('hidden');
                takeBtn.disabled = true;
                retakeBtn.classList.remove('hidden');
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    };
</script>
</x-app-layout>