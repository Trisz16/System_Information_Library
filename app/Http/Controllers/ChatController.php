<?php

namespace App\Http\Controllers;

use App\Jobs\SendChatbotFallback;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display chat index for students
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isMahasiswa()) {
            // Get admin/staff chats for student
            $adminChats = Chat::where('student_id', $user->id)
                ->where('type', 'admin_chat')
                ->with(['adminStaff', 'messages' => function($query) {
                    $query->latest()->limit(1);
                }])
                ->orderBy('last_message_at', 'desc')
                ->get();

            return view('chat.student_index', compact('adminChats'));
        } elseif ($user->isAdminOrStaff()) {
            // Get all active admin chats for admin/staff
            $activeChats = Chat::where('type', 'admin_chat')
                ->where('status', 'active')
                ->with(['student', 'messages' => function($query) {
                    $query->latest()->limit(1);
                }])
                ->orderBy('last_message_at', 'desc')
                ->get();

            return view('chat.admin_index', compact('activeChats'));
        }

        abort(403);
    }

    /**
     * Show AI Assistant interface for students
     */
    public function aiAssistant()
    {
        $user = Auth::user();

        if (!$user->isMahasiswa()) {
            abort(403);
        }

        // Predefined questions data
        $questionData = [
            'library' => [
                'title' => 'Tentang Perpustakaan',
                'questions' => [
                    'Apa nama perpustakaan ini?',
                    'Jam operasional perpustakaan?',
                    'Dimana lokasi perpustakaan?',
                    'Bagaimana cara menghubungi perpustakaan?',
                    'Apa saja layanan yang tersedia?'
                ]
            ],
            'books' => [
                'title' => 'Buku & Kategori',
                'questions' => [
                    'Ada berapa buku yang tersedia?',
                    'Jelaskan buku kategori history',
                    'Jelaskan buku kategori science',
                    'Jelaskan buku kategori literature',
                    'Jelaskan buku kategori technology',
                    'Bagaimana cara mencari buku?'
                ]
            ],
            'loans' => [
                'title' => 'Peminjaman Buku',
                'questions' => [
                    'Bagaimana cara meminjam buku?',
                    'Berapa lama durasi peminjaman?',
                    'Berapa lama menunggu verifikasi admin?',
                    'Apa syarat untuk meminjam buku?',
                    'Berapa denda keterlambatan?'
                ]
            ],
            'returns' => [
                'title' => 'Pengembalian Buku',
                'questions' => [
                    'Bagaimana cara mengembalikan buku?',
                    'Dimana tempat pengembalian buku?',
                    'Apakah ada denda jika rusak?'
                ]
            ],
            'membership' => [
                'title' => 'Keanggotaan',
                'questions' => [
                    'Bagaimana cara menjadi anggota?',
                    'Apa syarat keanggotaan?',
                    'Apakah perlu NIM untuk daftar?'
                ]
            ],
            'services' => [
                'title' => 'Layanan & Bantuan',
                'questions' => [
                    'Apa saja layanan perpustakaan?',
                    'Bagaimana cara mendapatkan bantuan?',
                    'Siapa yang bisa saya hubungi?'
                ]
            ]
        ];

        // Predefined answers data
        $answers = [
            'library' => [
                'Apa nama perpustakaan ini?' => 'Perpustakaan ini bernama Perpustakaan Azfakun, sebuah sistem perpustakaan modern yang menyediakan akses pengetahuan untuk semua kalangan.',
                'Jam operasional perpustakaan?' => 'Perpustakaan Azfakun buka setiap hari Senin-Jumat pukul 08:00-17:00 WIB, dan Sabtu pukul 08:00-14:00 WIB. Minggu dan hari libur nasional tutup.',
                'Dimana lokasi perpustakaan?' => 'Perpustakaan Azfakun terletak di Jl. Aladin, No. 777, Kota Atlantis. Kami memiliki fasilitas parkir yang memadai dan akses transportasi umum yang mudah.',
                'Bagaimana cara menghubungi perpustakaan?' => 'Anda dapat menghubungi kami melalui telepon (021) 1234567, email info@perpustakaan-azfakun.com, atau langsung datang ke lokasi perpustakaan.',
                'Apa saja layanan yang tersedia?' => 'Kami menyediakan layanan peminjaman buku, pengembalian, reservasi, layanan referensi, ruang baca, akses internet, dan berbagai program edukasi.'
            ],
            'books' => [
                'Ada berapa buku yang tersedia?' => 'Perpustakaan Azfakun memiliki lebih dari 50,000 judul buku yang terdiri dari berbagai kategori dan topik, termasuk buku cetak dan digital.',
                'Jelaskan buku kategori history' => 'Koleksi buku sejarah kami mencakup sejarah dunia, Indonesia, peradaban kuno, revolusi industri, dan berbagai periode historis penting dengan lebih dari 2,000 judul.',
                'Jelaskan buku kategori science' => 'Koleksi sains kami sangat lengkap dengan lebih dari 3,000 judul mencakup fisika, kimia, biologi, matematika, astronomi, dan teknologi terkini.',
                'Jelaskan buku kategori literature' => 'Koleksi sastra kami memiliki ribuan judul dari berbagai genre: novel, puisi, drama, sastra klasik dunia, sastra Indonesia, dan karya sastra modern.',
                'Jelaskan buku kategori technology' => 'Koleksi teknologi kami mencakup programming, AI, cybersecurity, data science, IoT, cloud computing, dan teknologi emerging dengan lebih dari 1,500 judul.',
                'Bagaimana cara mencari buku?' => 'Anda dapat mencari buku melalui katalog online di website kami, aplikasi mobile, atau langsung ke meja informasi perpustakaan dengan menyebutkan judul, penulis, atau subjek.'
            ],
            'loans' => [
                'Bagaimana cara meminjam buku?' => 'Untuk meminjam buku: 1) Daftar sebagai anggota, 2) Cari buku yang diinginkan, 3) Ajukan permintaan peminjaman melalui sistem online atau langsung ke perpustakaan, 4) Tunggu verifikasi admin.',
                'Berapa lama durasi peminjaman?' => 'Buku dapat dipinjam selama 14 hari untuk mahasiswa. Dapat diperpanjang 1 kali untuk 7 hari tambahan jika tidak ada reservasi dari anggota lain.',
                'Berapa lama menunggu verifikasi admin?' => 'Verifikasi admin biasanya memakan waktu 1-2 jam pada hari kerja. Pada saat sibuk, mungkin memakan waktu hingga 24 jam.',
                'Apa syarat untuk meminjam buku?' => 'Syarat peminjaman: 1) Terdaftar sebagai anggota aktif, 2) Melengkapi data diri, 3) Tidak memiliki denda yang belum dibayar, 4) Maksimal 3 buku per mahasiswa.',
                'Berapa denda keterlambatan?' => 'Denda keterlambatan adalah Rp 1,000 per hari per buku. Jika terlambat lebih dari 30 hari, buku dianggap hilang dan dikenakan denda pengganti sesuai harga buku.'
            ],
            'returns' => [
                'Bagaimana cara mengembalikan buku?' => 'Buku dapat dikembalikan melalui: 1) Drop box 24 jam di depan perpustakaan, 2) Meja pengembalian selama jam operasional, 3) Sistem online untuk peminjaman aktif.',
                'Dimana tempat pengembalian buku?' => 'Tempat pengembalian: 1) Meja sirkulasi utama, 2) Drop box di lobby perpustakaan (24 jam), 3) Counter pengembalian di setiap lantai.',
                'Apakah ada denda jika rusak?' => 'Ya, ada denda kerusakan buku tergantung tingkat kerusakan: ringan (Rp 50,000), sedang (Rp 100,000), berat (pengganti buku). Buku yang hilang dikenakan denda 2x harga buku.'
            ],
            'membership' => [
                'Bagaimana cara menjadi anggota?' => 'Untuk menjadi anggota: 1) Kunjungi perpustakaan, 2) Isi formulir pendaftaran, 3) Berikan NIM dan data diri, 4) Foto untuk kartu anggota, 5) Tunggu verifikasi admin.',
                'Apa syarat keanggotaan?' => 'Syarat keanggotaan: 1) Mahasiswa aktif, 2) NIM valid, 3) Email aktif, 4) Nomor telepon, 5) Alamat lengkap, 6) Bersedia mengikuti peraturan perpustakaan.',
                'Apakah perlu NIM untuk daftar?' => 'Ya, NIM (Nomor Induk Mahasiswa) wajib untuk pendaftaran karena digunakan sebagai identitas utama dan verifikasi status mahasiswa aktif.'
            ],
            'services' => [
                'Apa saja layanan perpustakaan?' => 'Layanan kami: peminjaman buku, ruang baca, akses internet, layanan fotokopi, bimbingan penelitian, workshop, diskusi, dan program literasi.',
                'Bagaimana cara mendapatkan bantuan?' => 'Bantuan dapat diperoleh melalui: 1) Chat dengan admin/staff, 2) Meja informasi, 3) Telepon/email, 4) Panduan online, 5) Tutorial penggunaan sistem.',
                'Siapa yang bisa saya hubungi?' => 'Anda dapat menghubungi: 1) Admin perpustakaan untuk masalah sistem, 2) Staff untuk bantuan umum, 3) Pustakawan untuk referensi akademik, 4) Tim IT untuk masalah teknis.'
            ]
        ];

        return view('chat.ai_assistant', compact('questionData', 'answers'));
    }

    /**
     * Show specific chat conversation
     */
    public function show(Chat $chat)
    {
        $user = Auth::user();

        // Check if user has access to this chat
        if ($user->isMahasiswa()) {
            // Students can only access their own chats
            if ($chat->student_id !== $user->id) {
                abort(403);
            }
        } elseif ($user->isAdminOrStaff()) {
            // Admin/staff can access admin chats (they can take over any admin chat)
            if (!$chat->isAdminChat()) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $messages = $chat->messages()->orderBy('created_at', 'asc')->get();

        // Mark messages as read for current user
        $chat->markAsReadForUser($user->id);

        if ($chat->isAdminChat()) {
            return view('chat.conversation', compact('chat', 'messages'));
        } elseif ($chat->isAiAssistant()) {
            return redirect()->route('chat.ai-assistant');
        }

        abort(404);
    }

    /**
     * Start a new chat with admin/staff
     */
    public function startChat(Request $request)
    {
        $user = Auth::user();

        if (!$user->isMahasiswa()) {
            abort(403);
        }

        // Check if student already has an active chat
        $existingChat = Chat::where('student_id', $user->id)
            ->where('type', 'admin_chat')
            ->where('status', 'active')
            ->first();

        if ($existingChat) {
            return response()->json(['chat_id' => $existingChat->id]);
        }

        // Find available admin/staff (prefer staff over admin)
        $adminStaff = User::whereIn('role', ['staff', 'admin'])
            ->orderByRaw("FIELD(role, 'staff', 'admin')")
            ->first();

        // Always allow chat creation, even if no admin/staff is immediately available
        $chat = Chat::create([
            'type' => 'admin_chat',
            'student_id' => $user->id,
            'admin_staff_id' => $adminStaff ? $adminStaff->id : null, // Can be null initially
            'status' => 'active',
            'last_message_at' => now(),
        ]);

        // Send initial message from student
        if ($request->has('initial_message') && !empty($request->initial_message)) {
            $message = Message::create([
                'chat_id' => $chat->id,
                'sender_id' => $user->id,
                'message' => $request->initial_message,
                'sender_type' => 'user',
            ]);

            // Send immediate chatbot response for new admin chat
            $this->generateImmediateChatbotResponse($chat, $request->initial_message);

            // Schedule chatbot fallback using job
            SendChatbotFallback::dispatch($chat, $message)->delay(now()->addMinutes(5));
        }

        return response()->json(['chat_id' => $chat->id]);
    }

    /**
     * Send a message
     */
    public function sendMessage(Request $request, Chat $chat)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        // Check if user has access to this chat
        if ($user->isMahasiswa()) {
            // Students can only access their own chats
            if ($chat->student_id !== $user->id) {
                abort(403);
            }
        } elseif ($user->isAdminOrStaff()) {
            // Admin/staff can access admin chats (they can take over any admin chat)
            if (!$chat->isAdminChat()) {
                abort(403);
            }
        } else {
            abort(403);
        }

        // Determine sender type
        $senderType = 'user';
        if ($user->isAdmin()) {
            $senderType = 'admin';
        } elseif ($user->isStaff()) {
            $senderType = 'staff';
        }

        // Create message
        $message = Message::create([
            'chat_id' => $chat->id,
            'sender_id' => $user->id,
            'message' => $request->message,
            'sender_type' => $senderType,
        ]);

        // Update chat's last message timestamp
        $chat->update(['last_message_at' => now()]);

        // If this is AI assistant chat and message is from student, generate chatbot response
        if ($chat->isAiAssistant() && $senderType === 'user') {
            $this->generateChatbotResponse($chat, $request->message);
        }

        // If this is admin chat and message is from student, send immediate chatbot response
        if ($chat->isAdminChat() && $senderType === 'user' && $chat->status === 'active') {
            // Try to assign admin if not already assigned
            if (!$chat->admin_staff_id) {
                $adminStaff = User::whereIn('role', ['staff', 'admin'])
                    ->orderByRaw("FIELD(role, 'staff', 'admin')")
                    ->first();

                if ($adminStaff) {
                    $chat->update(['admin_staff_id' => $adminStaff->id]);
                }
            }

            // Send immediate chatbot response
            $this->generateImmediateChatbotResponse($chat, $request->message);

            // Still schedule fallback in case admin wants to reply later
            SendChatbotFallback::dispatch($chat, $message)->delay(now()->addMinutes(5)); // Increased delay to 5 minutes
        }

        // Broadcast the message (we'll implement this later with WebSockets)
        // broadcast(new MessageSent($message))->toOthers();

        return response()->json(['success' => true, 'message' => $message]);
    }

    /**
     * Send predefined question to AI assistant
     */
    public function sendQuestion(Request $request, Chat $chat)
    {
        $request->validate([
            'question' => 'required|string',
            'category' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user->isMahasiswa() || !$chat->isAiAssistant() || $chat->student_id !== $user->id) {
            abort(403);
        }

        // Create user message
        $message = Message::create([
            'chat_id' => $chat->id,
            'sender_id' => $user->id,
            'message' => $request->question,
            'sender_type' => 'user',
            'metadata' => ['category' => $request->category],
        ]);

        // Update chat timestamp
        $chat->update(['last_message_at' => now()]);

        // Generate AI response
        $this->generateChatbotResponse($chat, $request->question, $request->category);

        return response()->json(['success' => true]);
    }



    /**
     * Generate immediate chatbot response for admin chat
     */
    private function generateImmediateChatbotResponse(Chat $chat, string $message)
    {
        // Simple keyword-based responses for common questions
        $responses = [
            // Greeting responses
            'halo' => 'Halo! Selamat datang di layanan chat perpustakaan Azfakun. Ada yang bisa saya bantu?',
            'hai' => 'Hai! Ada pertanyaan tentang perpustakaan?',
            'selamat pagi' => 'Selamat pagi! Perpustakaan Azfakun siap membantu Anda.',
            'selamat siang' => 'Selamat siang! Ada yang bisa saya bantu hari ini?',
            'selamat sore' => 'Selamat sore! Perpustakaan Azfakun siap melayani.',
            'selamat malam' => 'Selamat malam! Jika ada pertanyaan mendesak, silakan hubungi admin esok hari.',

            // Library info
            'jam buka' => 'Perpustakaan Azfakun buka Senin-Jumat pukul 08:00-17:00 WIB, dan Sabtu pukul 08:00-14:00 WIB.',
            'lokasi' => 'Perpustakaan Azfakun terletak di Jl. Aladin, No. 777, Kota Atlantis.',
            'kontak' => 'Hubungi kami di telepon (021) 1234567 atau email info@perpustakaan-azfakun.com',

            // Loan related
            'pinjam buku' => 'Untuk meminjam buku: 1) Pastikan Anda sudah terdaftar sebagai anggota, 2) Cari buku yang diinginkan, 3) Ajukan peminjaman melalui sistem online atau langsung ke perpustakaan.',
            'durasi pinjam' => 'Buku dapat dipinjam selama 14 hari untuk mahasiswa. Dapat diperpanjang 1 kali untuk 7 hari tambahan.',
            'denda' => 'Denda keterlambatan Rp 1,000 per hari per buku. Buku rusak dikenakan denda sesuai tingkat kerusakan.',

            // Return related
            'kembali buku' => 'Buku dapat dikembalikan melalui drop box 24 jam atau meja pengembalian selama jam operasional.',
        ];

        $lowerMessage = strtolower($message);
        $response = null;

        // Check for exact keyword matches
        foreach ($responses as $keyword => $reply) {
            if (strpos($lowerMessage, $keyword) !== false) {
                $response = $reply;
                break;
            }
        }

        // Default response if no keyword matches
        if (!$response) {
            $response = "Terima kasih atas pesan Anda. Admin perpustakaan akan segera membalas. Jika tidak ada balasan dalam 24 jam, silakan hubungi kami langsung di (021) 1234567. Jam operasional: Senin-Jumat 08:00-17:00 WIB, Sabtu 08:00-14:00 WIB.";
        }

        // Create chatbot response
        Message::create([
            'chat_id' => $chat->id,
            'sender_id' => 1, // Admin user ID
            'message' => $response,
            'sender_type' => 'chatbot',
            'metadata' => [
                'type' => 'immediate_response',
                'original_message' => $message
            ],
        ]);

        // Update chat timestamp
        $chat->update(['last_message_at' => now()]);
    }

    /**
     * Generate chatbot response based on question
     */
    private function generateChatbotResponse(Chat $chat, string $question, string $category = null)
    {
        // Predefined responses
        $responses = [
            'library' => [
                'Apa nama perpustakaan ini?' => 'Perpustakaan ini bernama Perpustakaan Azfakun, sebuah sistem perpustakaan modern yang menyediakan akses pengetahuan untuk semua kalangan.',
                'Jam operasional perpustakaan?' => 'Perpustakaan Azfakun buka setiap hari Senin-Jumat pukul 08:00-17:00 WIB, dan Sabtu pukul 08:00-14:00 WIB. Minggu dan hari libur nasional tutup.',
                'Dimana lokasi perpustakaan?' => 'Perpustakaan Azfakun terletak di Jl. Aladin, No. 777, Kota Atlantis. Kami memiliki fasilitas parkir yang memadai dan akses transportasi umum yang mudah.',
                'Bagaimana cara menghubungi perpustakaan?' => 'Anda dapat menghubungi kami melalui telepon (021) 1234567, email info@perpustakaan-azfakun.com, atau langsung datang ke lokasi perpustakaan.',
                'Apa saja layanan yang tersedia?' => 'Kami menyediakan layanan peminjaman buku, pengembalian, reservasi, layanan referensi, ruang baca, akses internet, dan berbagai program edukasi.'
            ],
            'books' => [
                'Ada berapa buku yang tersedia?' => 'Perpustakaan Azfakun memiliki lebih dari 50,000 judul buku yang terdiri dari berbagai kategori dan topik, termasuk buku cetak dan digital.',
                'Jelaskan buku kategori history' => 'Koleksi buku sejarah kami mencakup sejarah dunia, Indonesia, peradaban kuno, revolusi industri, dan berbagai periode historis penting dengan lebih dari 2,000 judul.',
                'Jelaskan buku kategori science' => 'Koleksi sains kami sangat lengkap dengan lebih dari 3,000 judul mencakup fisika, kimia, biologi, matematika, astronomi, dan teknologi terkini.',
                'Jelaskan buku kategori literature' => 'Koleksi sastra kami memiliki ribuan judul dari berbagai genre: novel, puisi, drama, sastra klasik dunia, sastra Indonesia, dan karya sastra modern.',
                'Jelaskan buku kategori technology' => 'Koleksi teknologi kami mencakup programming, AI, cybersecurity, data science, IoT, cloud computing, dan teknologi emerging dengan lebih dari 1,500 judul.',
                'Bagaimana cara mencari buku?' => 'Anda dapat mencari buku melalui katalog online di website kami, aplikasi mobile, atau langsung ke meja informasi perpustakaan dengan menyebutkan judul, penulis, atau subjek.'
            ],
            'loans' => [
                'Bagaimana cara meminjam buku?' => 'Untuk meminjam buku: 1) Daftar sebagai anggota, 2) Cari buku yang diinginkan, 3) Ajukan permintaan peminjaman melalui sistem online atau langsung ke perpustakaan, 4) Tunggu verifikasi admin.',
                'Berapa lama durasi peminjaman?' => 'Buku dapat dipinjam selama 14 hari untuk mahasiswa. Dapat diperpanjang 1 kali untuk 7 hari tambahan jika tidak ada reservasi dari anggota lain.',
                'Berapa lama menunggu verifikasi admin?' => 'Verifikasi admin biasanya memakan waktu 1-2 jam pada hari kerja. Pada saat sibuk, mungkin memakan waktu hingga 24 jam.',
                'Apa syarat untuk meminjam buku?' => 'Syarat peminjaman: 1) Terdaftar sebagai anggota aktif, 2) Melengkapi data diri, 3) Tidak memiliki denda yang belum dibayar, 4) Maksimal 3 buku per mahasiswa.',
                'Berapa denda keterlambatan?' => 'Denda keterlambatan adalah Rp 1,000 per hari per buku. Jika terlambat lebih dari 30 hari, buku dianggap hilang dan dikenakan denda pengganti sesuai harga buku.'
            ],
            'returns' => [
                'Bagaimana cara mengembalikan buku?' => 'Buku dapat dikembalikan melalui: 1) Drop box 24 jam di depan perpustakaan, 2) Meja pengembalian selama jam operasional, 3) Sistem online untuk peminjaman aktif.',
                'Dimana tempat pengembalian buku?' => 'Tempat pengembalian: 1) Meja sirkulasi utama, 2) Drop box di lobby perpustakaan (24 jam), 3) Counter pengembalian di setiap lantai.',
                'Apakah ada denda jika rusak?' => 'Ya, ada denda kerusakan buku tergantung tingkat kerusakan: ringan (Rp 50,000), sedang (Rp 100,000), berat (pengganti buku). Buku yang hilang dikenakan denda 2x harga buku.'
            ],
            'membership' => [
                'Bagaimana cara menjadi anggota?' => 'Untuk menjadi anggota: 1) Kunjungi perpustakaan, 2) Isi formulir pendaftaran, 3) Berikan NIM dan data diri, 4) Foto untuk kartu anggota, 5) Tunggu verifikasi admin.',
                'Apa syarat keanggotaan?' => 'Syarat keanggotaan: 1) Mahasiswa aktif, 2) NIM valid, 3) Email aktif, 4) Nomor telepon, 5) Alamat lengkap, 6) Bersedia mengikuti peraturan perpustakaan.',
                'Apakah perlu NIM untuk daftar?' => 'Ya, NIM (Nomor Induk Mahasiswa) wajib untuk pendaftaran karena digunakan sebagai identitas utama dan verifikasi status mahasiswa aktif.'
            ],
            'services' => [
                'Apa saja layanan perpustakaan?' => 'Layanan kami: peminjaman buku, ruang baca, akses internet, layanan fotokopi, bimbingan penelitian, workshop, diskusi, dan program literasi.',
                'Bagaimana cara mendapatkan bantuan?' => 'Bantuan dapat diperoleh melalui: 1) Chat dengan admin/staff, 2) Meja informasi, 3) Telepon/email, 4) Panduan online, 5) Tutorial penggunaan sistem.',
                'Siapa yang bisa saya hubungi?' => 'Anda dapat menghubungi: 1) Admin perpustakaan untuk masalah sistem, 2) Staff untuk bantuan umum, 3) Pustakawan untuk referensi akademik, 4) Tim IT untuk masalah teknis.'
            ]
        ];

        // Find matching response
        $response = 'Maaf, saya tidak dapat menjawab pertanyaan tersebut. Silakan hubungi admin perpustakaan untuk bantuan lebih lanjut.';

        if ($category && isset($responses[$category])) {
            if (isset($responses[$category][$question])) {
                $response = $responses[$category][$question];
            }
        } else {
            // Search across all categories
            foreach ($responses as $catResponses) {
                if (isset($catResponses[$question])) {
                    $response = $catResponses[$question];
                    break;
                }
            }
        }

        // Create chatbot response
        Message::create([
            'chat_id' => $chat->id,
            'sender_id' => 1, // Admin user ID
            'message' => $response,
            'sender_type' => 'chatbot',
            'metadata' => ['question' => $question, 'category' => $category],
        ]);

        // Update chat timestamp
        $chat->update(['last_message_at' => now()]);
    }

    /**
     * Close a chat
     */
    public function closeChat(Chat $chat)
    {
        $user = Auth::user();

        // Only admin/staff can close chats
        if (!$user->isAdminOrStaff()) {
            abort(403);
        }

        // Admin/staff can close any admin chat they have access to
        if (!$chat->isAdminChat()) {
            abort(403);
        }

        $chat->update(['status' => 'closed']);

        return response()->json(['success' => true]);
    }

    /**
     * Get unread messages count
     */
    public function getUnreadCount()
    {
        $user = Auth::user();

        if ($user->isMahasiswa()) {
            $count = Chat::where('student_id', $user->id)
                ->whereHas('messages', function($query) use ($user) {
                    $query->where('sender_id', '!=', $user->id)
                          ->where('is_read', false);
                })
                ->count();
        } elseif ($user->isAdminOrStaff()) {
            $count = Chat::where('admin_staff_id', $user->id)
                ->where('type', 'admin_chat')
                ->whereHas('messages', function($query) use ($user) {
                    $query->where('sender_id', '!=', $user->id)
                          ->where('is_read', false);
                })
                ->count();
        } else {
            $count = 0;
        }

        return response()->json(['unread_count' => $count]);
    }
}
