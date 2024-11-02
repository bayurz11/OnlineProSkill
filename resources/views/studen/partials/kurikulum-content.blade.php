 {{-- @dd($kurikulum) --}}
 @if ($kurikulum->isEmpty())
     <p>Data kurikulum belum tersedia.</p>
 @else
     <div class="accordion" id="accordionExample">
         @foreach ($kurikulum as $index => $item)
             <div class="accordion-item">
                 <h2 class="accordion-header" id="heading{{ $index }}">
                     <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                         data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                         aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                         aria-controls="collapse{{ $index }}">
                         {{ $item->title }}
                         <span>{{ $item->sections->count() }}/{{ $item->sections->count() }}</span>
                     </button>
                 </h2>
                 <div id="collapse{{ $index }}"
                     class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                     data-bs-parent="#accordionExample">
                     <div class="accordion-body">
                         <ul class="list-wrap">
                             @foreach ($item->sections as $section)
                                 <li class="course-item {{ $loop->first ? 'open-item' : '' }}">
                                     @php
                                         $completed = Auth::user()->hasCompletedSection($section->id);
                                     @endphp
                                     @if ($section->link || $section->file_path)
                                         <a href="#"
                                             class="course-item-link {{ $loop->first ? 'active' : '' }} {{ !$completed && $loop->first ? 'unlocked' : (!$completed ? 'locked' : '') }}"
                                             data-title="{{ $section->title }}"
                                             data-link="{{ $section->link ? asset($section->link) : asset($section->file_path) }}"
                                             data-type="{{ $section->type }}" data-id="{{ $section->id }}"
                                             onclick="changeContent(this, event)">
                                             <span class="item-name">{{ $section->title }}</span>
                                             @if ($completed)
                                                 <div class="d-flex align-items-center justify-content-center">
                                                     <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width: 24px; height: 24px;">
                                                         <i class="fas fa-check"></i>
                                                     </div>
                                                 </div>
                                             @endif
                                             <div class="course-item-meta">
                                                 <span class="item-meta duration">{{ $section->duration }}</span>
                                             </div>
                                         </a>
                                     @else
                                         <span class="course-item-link inactive">
                                             <span class="item-name">{{ $section->title }}</span>
                                             <div class="course-item-meta">
                                                 <span class="item-meta duration">{{ $section->duration }}</span>
                                             </div>
                                         </span>
                                     @endif
                                 </li>
                             @endforeach
                         </ul>
                     </div>
                 </div>
             </div>
         @endforeach
     </div>
 @endif
 <script>
     function changeContent(element, event) {
         if (element.classList.contains('disabled')) {
             event.preventDefault();
             alert('Bagian ini terkunci, selesaikan bagian sebelumnya untuk membuka bagian ini.');
             return;
         }

         var fileUrl = element.getAttribute('data-link');
         var fileType = element.getAttribute('data-type');
         var sectionId = element.getAttribute('data-id');
         console.log('fileUrl:', fileUrl);
         console.log('fileType:', fileType);
         console.log('sectionId:', sectionId);

         // Update the hidden input with the clicked section ID
         document.getElementById('sectionId').value = sectionId;

         var youtubeRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
         var driveRegex =
             /(?:drive\.google\.com\/file\/d\/|drive\.google\.com\/open\?id=|docs.google\.com\/(?:presentation|document|spreadsheets)\/d\/)([^"&?\/\s]+)/;
         var youtubeMatch = fileUrl.match(youtubeRegex);
         var driveMatch = fileUrl.match(driveRegex);
         var fileSrc = '';

         if (youtubeMatch) {
             var youtubeId = youtubeMatch[1];
             fileSrc = 'https://www.youtube.com/embed/' + youtubeId;
         } else if (driveMatch) {
             var driveId = driveMatch[1];

             if (fileType === 'video') {
                 fileSrc = 'https://drive.google.com/file/d/' + driveId + '/preview';
             } else if (fileType === 'presentation' || fileType === 'pptx') {
                 fileSrc = 'https://docs.google.com/presentation/d/' + driveId + '/embed';
             } else if (fileType === 'document' || fileType === 'docx') {
                 fileSrc = 'https://docs.google.com/document/d/' + driveId + '/embed';
             } else if (fileType === 'spreadsheet' || fileType === 'xlsx') {
                 fileSrc = 'https://docs.google.com/spreadsheets/d/' + driveId + '/embed';
             } else if (fileType === 'pdf') {
                 fileSrc = 'https://drive.google.com/file/d/' + driveId + '/preview';
             } else {
                 alert('Jenis file tidak didukung: ' + fileType);
                 return;
             }
         } else if (fileType === 'pdf' || fileUrl.includes('uploads/')) {
             if (fileUrl.startsWith('https://')) {
                 fileSrc = '/public/' + fileUrl.split('/').slice(3).join('/');
             } else if (!fileUrl.startsWith('/public/uploads/')) {
                 fileSrc = '/public/' + fileUrl;
             } else {
                 fileSrc = fileUrl;
             }
         } else {
             alert('Link file tidak valid: ' + fileUrl);
             return;
         }

         document.getElementById('lessonContent').src = fileSrc;
         document.getElementById('currentContentTitle').innerText = element.getAttribute('data-title');

         // Remove active class from previously active links
         var activeLinks = document.querySelectorAll('.course-item-link.active');
         activeLinks.forEach(function(link) {
             link.classList.remove('active');
         });

         // Add active class to the clicked link
         element.classList.add('active');
     }

     document.addEventListener('DOMContentLoaded', function() {
         var firstFileLink = document.querySelector('.course-item-link.active');
         if (firstFileLink) {
             changeContent(firstFileLink, new Event('click'));
         }
     });

     function nextContent() {
         var activeLink = document.querySelector('.course-item-link.active');
         var nextLink = activeLink.parentElement.nextElementSibling?.querySelector('.course-item-link');
         if (nextLink) {
             changeContent(nextLink, new Event('click'));
         }
     }

     function prevContent() {
         var activeLink = document.querySelector('.course-item-link.active');
         var prevLink = activeLink.parentElement.previousElementSibling?.querySelector('.course-item-link');
         if (prevLink) {
             changeContent(prevLink, new Event('click'));
         }
     }

     function refreshKurikulumContent() {
         // Lakukan permintaan fetch untuk mendapatkan konten terbaru
         fetch(
                 "{{ route('kurikulum-content', $kurikulum[0]->sections->first()->id) }}"
                 ) // Ubah ke rute yang sesuai untuk mendapatkan konten
             .then(response => response.text())
             .then(html => {
                 // Ganti konten yang ada dengan konten baru
                 document.querySelector('.lesson__content').innerHTML = html;
             })
             .catch(error => console.error('Error fetching kurikulum content:', error));
     }

     function submitStatusForm(event) {
         event.preventDefault();
         const form = document.getElementById('statusForm');
         const formData = new FormData(form);

         fetch(form.action, {
                 method: 'POST',
                 body: formData,
                 headers: {
                     'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                 }
             })
             .then(response => {
                 if (response.ok) {
                     // Pindah ke konten berikutnya setelah status diperbarui
                     const activeLink = document.querySelector('.course-item-link.active');
                     const nextLink = activeLink.parentElement.nextElementSibling?.querySelector(
                         '.course-item-link');
                     if (nextLink) {
                         changeContent(nextLink, new Event('click'));
                     }

                     // Panggil refresh setelah status diperbarui
                     refreshKurikulumContent();
                     alert("Status berhasil diperbarui dan konten diperbarui.");
                 } else {
                     console.error("Error: " + response.statusText);
                 }
             })
             .catch(error => console.error("Fetch error:", error));
     }
 </script>
