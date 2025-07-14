<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Group Chat | Connect & Share</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            --chat-bg: #f0f4f8;
            --user-panel: #4a6cf7;
            --message-own: #4a6cf7;
            --message-other: #ffffff;
            --shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        body {
            background: var(--primary-gradient);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .chat-container {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
            height: 90vh;
            max-width: 1200px;
            transition: var(--transition);
        }
        
        /* User Panel */
        .user-panel {
            background: var(--user-panel);
            color: white;
            padding: 1.5rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }
        
        .user-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 125px;
            background: var(--secondary-gradient);
            z-index: -1;
            border-radius: 0 0 50% 50%;
            transform: scale(2);
            width: 210px;
        }
        
        .user-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--user-panel);
            font-weight: bold;
        }
        
        .user-list {
            flex-grow: 1;
            overflow-y: auto;
            padding-right: 10px;
        }
        
        .user-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            margin-bottom: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            transition: var(--transition);
        }
        
        .user-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }
        
        .user-item.active {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .user-item-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--user-panel);
            font-weight: bold;
        }
        
        /* Chat Area */
        .chat-area {
            display: flex;
            flex-direction: column;
            height: 100%;
            background: var(--chat-bg);
        }
        
        .chat-header {
            padding: 1.2rem 1.5rem;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 1;
        }
        
        .chat-title {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: #2d3748;
        }
        
        .chat-title i {
            margin-right: 10px;
            color: var(--user-panel);
        }
        
        .chat-actions .btn {
            margin-left: 10px;
            border-radius: 8px;
        }
        
        .chat-messages {
            flex-grow: 1;
            padding: 1.5rem;
            overflow-y: auto;
            background: url('https://subtlepatterns.com/patterns/light_noise_diagonal.png');
            background-size: 300px;
            opacity: 0.98;
        }
        
        .message {
            display: flex;
            margin-bottom: 15px;
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .message-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
            align-self: flex-end;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: var(--user-panel);
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .message-content {
            max-width: 70%;
        }
        
        .message-bubble {
            padding: 12px 16px;
            border-radius: 18px;
            position: relative;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            line-height: 1.4;
            word-break: break-word;
        }
        
        .message-info {
            font-size: 0.75rem;
            color: #718096;
            margin-top: 4px;
            display: flex;
            align-items: center;
        }
        
        .message-own {
            justify-content: flex-end;
        }
        
        .message-own .message-content {
            margin-left: auto;
        }
        
        .message-own .message-bubble {
            background: var(--message-own);
            color: white;
            border-bottom-right-radius: 4px;
        }
        
        .message-other .message-bubble {
            background: var(--message-other);
            color: #2d3748;
            border-bottom-left-radius: 4px;
        }
        
        .message-input-area {
            padding: 1rem;
            background: white;
            border-top: 1px solid #edf2f7;
            display: flex;
            align-items: center;
        }
        
        .message-input {
            flex-grow: 1;
            border: none;
            background: #f8fafc;
            border-radius: 12px;
            padding: 12px 18px;
            margin-right: 12px;
            font-size: 0.95rem;
            transition: var(--transition);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .message-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.2);
            background: white;
        }
        
        .send-button {
            background: var(--user-panel);
            color: white;
            border: none;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 10px rgba(74, 108, 247, 0.3);
        }
        
        .send-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(74, 108, 247, 0.4);
        }
        
        /* Share Section */
        .share-section {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .share-toggle {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            transition: var(--transition);
            backdrop-filter: blur(5px);
        }
        
        .share-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .share-toggle i {
            margin-right: 8px;
        }
        
        .share-options {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 15px;
            margin-top: 12px;
            backdrop-filter: blur(10px);
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .share-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            border: none;
            color: white;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .share-btn i {
            margin-right: 8px;
        }
        
        .share-btn-whatsapp {
            background: #25D366;
        }
        
        .share-btn-facebook {
            background: #1877F2;
        }
        
        .share-btn-instagram {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        }
        
        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .copy-link-container {
            display: flex;
            margin-top: 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .copy-link-input {
            flex-grow: 1;
            background: transparent;
            border: none;
            padding: 10px;
            color: white;
        }
        
        .copy-link-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .copy-link-button {
            background: rgba(255, 255, 255, 0.3);
            border: none;
            color: white;
            padding: 0 15px;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .copy-link-button:hover {
            background: rgba(255, 255, 255, 0.4);
        }
        
        /* Logout Button */
        .logout-btn {
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin-top: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        
        .logout-btn:hover {
            background: rgba(255, 99, 71, 0.3);
            color: #ff6347;
        }
        
        .logout-btn i {
            margin-right: 8px;
        }
        
        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.3);
        }
        
        /* Responsive Adjustments */
       @media (max-width: 768px) {
    body {
        padding: 0;
    }

    .chat-container {
        display: flex;
        flex-direction: column;
        height: 100vh;
        border-radius: 0;
        max-width: 100%;
    }

    .user-panel {
        display: none; /* Optional: Hide side user list on mobile for focus */
    }

    .chat-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .chat-header {
        padding: 1rem;
        font-size: 1rem;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
    }

    .message-input-area {
        padding: 0.75rem;
        flex-direction: row;
        gap: 10px;
        background: #fff;
        border-top: 1px solid #ccc;
    }

    .message-input {
        flex: 1;
        padding: 10px;
        font-size: 0.95rem;
    }

    .send-button {
        width: 50px;
        height: 50px;
        font-size: 18px;
    }

    .message-content {
        max-width: 85%;
    }

    .chat-title span {
        font-size: 1rem;
    }

    .message-bubble {
        font-size: 0.95rem;
    }

        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="chat-container row g-0">
        <!-- User Panel -->
        <div class="col-md-3 user-panel">
            <div class="user-header">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <small class="text-white-50">Online</small>
            </div>
            
  <div class="user-list">
    <h6 class="text-white mb-3">
        <i class="bi bi-people-fill me-2"></i>Active Members
    </h6>

    @foreach($messageUsers as $user)
        <div class="user-item {{ $user->id === $currentUser->id ? 'active' : '' }}">
            <div class="user-item-avatar">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div class="fw-medium">{{ $user->name }}</div>
                <small class="text-white-50">
                    {{ $user->id === $currentUser->id ? 'You' : 'Active' }}
                </small>
            </div>
        </div>
    @endforeach
</div>

            
            <!-- Share Section -->
            <div class="share-section">
                <button class="share-toggle" onclick="toggleShare()">
                    <i class="bi bi-share-fill"></i> Invite Friends
                </button>
                
                <div id="share-options" class="share-options d-none">
                    <button class="share-btn share-btn-whatsapp" onclick="shareOnWhatsApp()">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </button>
                    
                    <button class="share-btn share-btn-facebook" onclick="shareOnFacebook()">
                        <i class="bi bi-facebook"></i> Facebook
                    </button>
                    
                    <button class="share-btn share-btn-instagram" onclick="shareOnInstagram()">
                        <i class="bi bi-instagram"></i> Instagram
                    </button>
                    
                    <div class="copy-link-container">
                        <input type="text" class="copy-link-input" value="{{ url('/register') }}?ref=groupchat" readonly id="share-link" placeholder="Group invite link">
                        <button class="copy-link-button" onclick="copyLink()">
                            <i class="bi bi-clipboard"></i>
                        </button>
                    </div>
                </div>
                
                <a href="{{ route('logout') }}" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
        
        <!-- Chat Area -->
        <div class="col-md-9 chat-area">
            <div class="chat-header">
                <div class="chat-title">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span>Group Chat</span>
                </div>
                
                <div class="chat-actions">
                    <form action="{{ route('chat.clear') }}" method="POST" onsubmit="return confirm('Clear all messages?')">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash"></i> Clear
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="chat-messages">
                @forelse($messages as $msg)
                    <div class="message {{ $msg->user_id === Auth::id() ? 'message-own' : 'message-other' }}">
                        @if($msg->user_id !== Auth::id())
                        <div class="message-avatar">
                            {{ strtoupper(substr($msg->user->name, 0, 1)) }}
                        </div>
                        @endif
                        
                        <div class="message-content">
                            <div class="message-bubble">
                                @if($msg->user_id !== Auth::id())
                                <div class="fw-medium">{{ $msg->user->name }}</div>
                                @endif
                                {{ $msg->message }}
                            </div>
                            <div class="message-info">
                                <small>{{ $msg->created_at->format('h:i A') }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center mt-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/4208/4208369.png" width="120" class="opacity-50 mb-3">
                        <h5 class="text-muted">No messages yet</h5>
                        <p class="text-muted">Start the conversation!</p>
                    </div>
                @endforelse
            </div>
            
            <form method="POST" action="{{ route('chat.send') }}" class="message-input-area">
                @csrf
                <input type="text" name="message" class="message-input" placeholder="Type your message..." required>
                <button type="submit" class="send-button">
                    <i class="bi bi-send-fill"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-scroll to bottom of chat
    const chatMessages = document.querySelector('.chat-messages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
    
    // Toggle share options
    function toggleShare() {
        const options = document.getElementById('share-options');
        options.classList.toggle('d-none');
    }
    
    // Copy link function
    function copyLink() {
        const input = document.getElementById('share-link');
        input.select();
        document.execCommand('copy');
        
        // Show tooltip or notification
        const copyBtn = document.querySelector('.copy-link-button');
        const originalHtml = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="bi bi-check"></i> Copied!';
        
        setTimeout(() => {
            copyBtn.innerHTML = originalHtml;
        }, 2000);
    }
    
    // Share functions
    function shareOnWhatsApp() {
        const shareUrl = encodeURIComponent("{{ url('/register') }}?ref=groupchat");
        window.open(`https://wa.me/?text=Join%20our%20chat%20group%20here:%20${shareUrl}`, '_blank');
    }
    
    function shareOnFacebook() {
        const shareUrl = encodeURIComponent("{{ url('/register') }}?ref=groupchat");
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${shareUrl}`, '_blank');
    }
    
    function shareOnInstagram() {
        // Instagram doesn't have direct share API, so we open the app
        window.open('instagram://app', '_blank');
    }
    
    // Smooth scroll for new messages
    function scrollToBottom() {
        chatMessages.scrollTo({
            top: chatMessages.scrollHeight,
            behavior: 'smooth'
        });
    }
    
    // Example of how you might handle new messages (you would implement this with your real-time functionality)
    function addNewMessage(message, isOwn) {
        const messagesContainer = document.querySelector('.chat-messages');
        
        // Create message element
        const messageEl = document.createElement('div');
        messageEl.className = `message ${isOwn ? 'message-own' : 'message-other'}`;
        
        if (!isOwn) {
            messageEl.innerHTML = `
                <div class="message-avatar">${message.user.charAt(0).toUpperCase()}</div>
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="fw-medium">${message.user}</div>
                        ${message.text}
                    </div>
                    <div class="message-info">
                        <small>${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</small>
                    </div>
                </div>
            `;
        } else {
            messageEl.innerHTML = `
                <div class="message-content">
                    <div class="message-bubble">
                        ${message.text}
                    </div>
                    <div class="message-info">
                        <small>${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</small>
                    </div>
                </div>
            `;
        }
        
        messagesContainer.appendChild(messageEl);
        scrollToBottom();
    }
</script>

</body>
</html>