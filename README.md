# 🔐 Facebook OAuth (Laravel Socialite) — Production Setup

Production-ready implementation of Facebook authentication using Laravel Socialite.

This setup uses :contentReference[oaicite:0]{index=0}.

---

## ⚙️ Environment Variables

Add to `.env`:

FACEBOOK_CLIENT_ID=your_facebook_app_id  
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret  
FACEBOOK_REDIRECT_URI=${APP_URL}/auth/facebook/callback

---

## 🧱 Facebook App Setup

Create app here: https://developers.facebook.com/

Steps:
1. Create App → choose “Consumer”
2. Complete basic setup
3. Go to App Dashboard

---

## ⚙️ App Configuration

### Basic Settings
Go to Settings → Basic:

- App ID → FACEBOOK_CLIENT_ID
- App Secret → FACEBOOK_CLIENT_SECRET

---

### App Icon
- Size: 1024×1024 px
- Must be square

---

### Privacy Policy URL (required)
Must be publicly accessible.

You can use:
- Notion / GitHub Pages / hosted page
- Generator: https://www.freeprivacypolicy.com/free-privacy-policy-generator/

---

### Data Deletion URL (required)

Example:
https://your-domain.com/legal/facebook-data-deletion

Minimal content:
Users can request deletion of their data by contacting support@domain.com. Requests are processed within 7 days.

---

## 🔐 Facebook Login Configuration

Go to:
Products → Facebook Login → Settings

### Valid OAuth Redirect URIs

Local:
http://localhost:8000/auth/facebook/callback

Production:
https://your-domain.com/auth/facebook/callback

⚠️ Must match exactly (strict mode recommended)

---

## 🔑 Permissions (Scopes)

Used scope:
['email']

Includes:
- public_profile (default)
- email

---
