; Script generated by the Inno Setup Script Wizard.
; SEE THE DOCUMENTATION FOR DETAILS ON CREATING INNO SETUP SCRIPT FILES!

#define MyAppName "POS"
#define MyAppVersion "1.1"
#define MyAppPublisher "Citra Utama"
#define MyAppURL "http://www.CitraUtama.com/"
#define MyAppExeName "MyProg.exe"

[Setup]
; NOTE: The value of AppId uniquely identifies this application.
; Do not use the same AppId value in installers for other applications.
; (To generate a new GUID, click Tools | Generate GUID inside the IDE.)
AppId={{F165D7FA-D808-48DE-B60A-F809DDAACA57}
AppName={#MyAppName}
AppVersion={#MyAppVersion}
;AppVerName={#MyAppName} {#MyAppVersion}
AppPublisher={#MyAppPublisher}
AppPublisherURL={#MyAppURL}
AppSupportURL={#MyAppURL}
AppUpdatesURL={#MyAppURL}
CreateAppDir=no
OutputDir=D:\startup\Setup POS
OutputBaseFilename=POS Setup
SetupIconFile=D:\Program VB\Program\PO SEIWA\Icon\HRD.ico
Compression=lzma
SolidCompression=yes

[Languages]
Name: "english"; MessagesFile: "compiler:Default.isl"

[Files]
Source: "D:\Program VB\Program\PO SEIWA\POSEIWA.exe"; DestDir: "{win}"; Flags: ignoreversion
; NOTE: Don't use "Flags: ignoreversion" on any shared system files

