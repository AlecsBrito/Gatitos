import WaveSurfer from '../lib/wavesurfer.js@7.4.5/dist/wavesurfer.esm.js'
import RecordPlugin from '../lib/wavesurfer.js@7.4.5/dist/plugins/record.esm.js'

const localAudio = document.getElementById("localAudio");
const toggleMicrophoneButton = document.getElementById("toggleMicrophoneButton");
const micSelect = document.querySelector('#mic-select');
const recButton = document.querySelector('#toggleMicrophoneButton');
let WebSocketServer = "*localhost:8443";
let isMicrophoneMuted = true; // Inicia desativado
let localStream;
let peerConnection;

// Esconder as opções ao remover o mouse
document.querySelector("#mic-select").addEventListener('mouseout', function () {
	this.blur();
});

const wavesurfer = WaveSurfer.create({
	container: '#mic',
	waveColor: '#fdf2e6',
});

const record = wavesurfer.registerPlugin(RecordPlugin.create());

const microphoneIcon = document.getElementById("microphoneIcon");
microphoneIcon.src = isMicrophoneMuted ? "../images/icons/micOff.svg" : "../images/icons/micOn.svg";

toggleMicrophoneButton.addEventListener("click", toggleMicrophone);

recButton.onclick = toggleRecording;

navigator.mediaDevices.getUserMedia({ audio: true })
	.then(initMedia)
	.catch(error => console.error("Erro ao acessar o microfone: " + error));

function initMedia(stream) {
	localStream = stream;
	localAudio.srcObject = stream;
	stream.getTracks().forEach(track => {
		track.enabled = !isMicrophoneMuted; // Ajusta o estado do microfone
		peerConnection.addTrack(track, stream);
	});

	const signalingServer = new WebSocket('wss://' + WebSocketServer);
	signalingServer.onmessage = handleSignalingData;

	peerConnection.createOffer()
		.then(offer => peerConnection.setLocalDescription(offer))
		.then(() => signalingServer.send(JSON.stringify(peerConnection.localDescription)))
		.catch(error => console.error("Erro ao criar oferta: " + error));
}

function handleSignalingData(event) {
	const message = JSON.parse(event.data);

	if (['offer', 'answer', 'ice-candidate'].includes(message.type)) {
		peerConnection.setRemoteDescription(new RTCSessionDescription(message))
			.catch(error => console.error("Erro ao processar descrição remota: " + error));
	}
}

RecordPlugin.getAvailableAudioDevices().then(renderMicOptions);

function renderMicOptions(devices) {
	devices.forEach(device => {
		const option = document.createElement('option');
		option.value = device.deviceId;
		option.text = device.label || device.deviceId;
		micSelect.appendChild(option);
	});

	const defaultMic = devices.find(device => device.kind === 'audioinput' && device.label.toLowerCase().includes('default'));
	if (defaultMic) micSelect.value = defaultMic.deviceId;
}

function toggleMicrophone() {
	isMicrophoneMuted = !isMicrophoneMuted;
	localStream.getAudioTracks().forEach(track => {
		track.enabled = !isMicrophoneMuted; // Atualiza o estado do microfone
	});
	updateMicrophoneIcon();
}

function toggleRecording() {
	if (record.isRecording()) {
		record.stopRecording();
		updateMicrophoneIcon();
	} else {
		recButton.disabled = true;
		const deviceId = micSelect.value;
		record.startRecording({ deviceId })
			.then(() => recButton.disabled = false);
	}
}

function updateMicrophoneIcon() {
	microphoneIcon.src = isMicrophoneMuted ? "../images/icons/micOff.svg" : "../images/icons/micOn.svg";
}

// No código do cliente
signalingServer.onopen = () => {
	console.log('Conexão WebSocket aberta com sucesso.');
	signalingServer.send('Olá, servidor! Esta é uma mensagem de teste.');
};


