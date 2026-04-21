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

# LinkedIn OAuth Authentication Setup (Laravel)

This guide explains how to set up LinkedIn OAuth login in a Laravel application using Laravel Socialite.

---

## 1. Create LinkedIn App

Go to:  
https://www.linkedin.com/developers/

### Steps:
1. Click **Create app**
2. Fill in required fields:
    - App name (e.g. `MyApp Auth`)
    - LinkedIn Page (you must have or create a company page)
    - Logo (required)

---

## 2. Enable Products

Inside your app dashboard:

Go to **Products** tab and enable:

- **Sign In with LinkedIn using OpenID Connect**

Click **Request Access** if required.

---

## 3. Configure OAuth Settings

Go to:

**Auth → OAuth 2.0 settings**

Add Redirect URL:

### Production
