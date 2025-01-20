@extends('layouts.master')

@section('content')
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <!-- Header -->
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Search Hospitals</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Hospitals</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Search
                </li>
            </ul>
        </div>

        <!-- Layout -->
        <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
            <!-- Search Form -->
            <div class="xl:col-span-3">
                <div class="sticky card print:hidden top-[calc(theme('spacing.header')_+_theme('spacing.5'))]">
                    <div class="card-body">
                        <h6 class="mb-4 text-16">Search Filters</h6>
                        <form id="hospitalSearchForm">
                            <div class="mb-3">
                                <label for="province" class="inline-block mb-2 text-base font-medium">Province</label>
                                <select id="province" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    <option value="" selected>Select Province</option>
                                    <option value="City of Kigali">City of Kigali</option>
                                    <option value="Eastern Province">Eastern Province</option>
                                    <option value="Northern Province">Northern Province</option>
                                    <option value="Southern Province">Southern Province</option>
                                    <option value="Western Province">Western Province</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="district" class="inline-block mb-2 text-base font-medium">District</label>
                                <select id="district" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    <option value="" selected>Select District</option>
                                </select>
                            </div>

                            <button type="button" id="searchButton" class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="search" class="inline-block size-4 ltr:mr-1 rtl:ml-1"></i> Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <div class="xl:col-span-9">
                <div class="card">
                    <div class="card-body">
                        <div id="results">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-slate-100 dark:bg-zink-600">
                                        <tr>
                                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 text-slate-800 dark:text-zink-50">Hospital Name</th>
                                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 text-slate-800 dark:text-zink-50">Address</th>
                                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 text-slate-800 dark:text-zink-50">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hospitalList">
                                        <!-- Results will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const districtsByProvince = {
        'City of Kigali': ['Gasabo', 'Kicukiro', 'Nyarugenge'],
        'Eastern Province': ['Bugesera', 'Gatsibo', 'Kayonza', 'Kirehe', 'Ngoma', 'Nyagatare', 'Rwamagana'],
        'Northern Province': ['Burera', 'Gakenke', 'Gicumbi', 'Musanze', 'Rulindo'],
        'Southern Province': ['Gisagara', 'Huye', 'Kamonyi', 'Muhanga', 'Nyamagabe', 'Nyanza', 'Nyaruguru', 'Ruhango'],
        'Western Province': ['Karongi', 'Ngororero', 'Nyabihu', 'Nyamasheke', 'Rubavu', 'Rusizi', 'Rutsiro']
    };

    document.getElementById('province').addEventListener('change', function() {
        const province = this.value;
        const districtSelect = document.getElementById('district');
        districtSelect.innerHTML = '<option value="" selected>Select District</option>';

        if (districtsByProvince[province]) {
            districtsByProvince[province].forEach(district => {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        }
    });

    document.getElementById('searchButton').addEventListener('click', function() {
        const province = document.getElementById('province').value;
        const district = document.getElementById('district').value;

        fetch('/client/hospitals/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                province,
                district
            })
        })
        .then(response => response.json())
        .then(data => {
            const list = document.getElementById('hospitalList');
            list.innerHTML = '';

            if (data.data.length > 0) {
                data.data.forEach(hospital => {
                    list.innerHTML += `
                        <tr class="border-b border-slate-200 dark:border-zink-500">
                            <td class="px-3.5 py-2.5 text-slate-700 dark:text-zink-100">${hospital.name}</td>
                            <td class="px-3.5 py-2.5 text-slate-700 dark:text-zink-100">${hospital.address}</td>
                            <td class="px-3.5 py-2.5">
                                <a href="#" class="text-custom-500 hover:text-custom-600">View Details</a>
                            </td>
                        </tr>
                    `;
                });
            } else {
                list.innerHTML = `
                    <tr>
                        <td colspan="3" class="px-3.5 py-2.5 text-center text-slate-500 dark:text-zink-200">
                            No hospitals found for the selected criteria.
                        </td>
                    </tr>
                `;
            }
        })
        .catch(error => console.error('Error fetching hospitals:', error));
    });
</script>
@endsection
